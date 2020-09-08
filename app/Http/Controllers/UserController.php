<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Bodega;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UploadBase64;

class UserController extends Controller {

    public function index(Request $request) {
        $company = Auth::user()->company;
        $users = User::with('role')
                ->where('company_id', $company->id)
                ->orderBy('id', 'desc')
                ->get();

        return view('pages.users.index', compact('users'));
    }

    public function create(Request $request) {

        $company = Auth::user()->company;
        $roles = Role::where('is_owner', false)
                ->where('company_id', $company->id)
                ->get();

        $bodegas = Bodega::where('company_id', $company->id)->get();

        return view('pages.users.create', compact('roles', 'bodegas'));
    }

    public function store(Request $request) {

        $user = new User();
        $this->formValidate($request, $user);
        $this->save($request, $user);

        return redirect('empresa/users')->with('message', 'Usuario creado correctamente');
    }

    public function edit(Request $request, $id) {

        $company = Auth::user()->company;
        $user = User::where('company_id', $company->id)
                ->with('bodegas')
                ->where('id', $id)
                ->firstOrFail();

        $roles = Role::where('is_owner', false)
                ->where('company_id', $company->id)
                ->get();

        $bodegas = Bodega::where('company_id', $company->id)->get();

        return view('pages.users.edit', compact('user', 'roles', 'bodegas'));
    }

    public function update(Request $request, $id) {

        $user = User::find($id);
        $this->formValidate($request, $user);
        $this->save($request, $user);

        return redirect('empresa/users')->with('message', 'Usuario actualizado correctamente');
    }

    private function formValidate($request, $user) {

        $niceNames = [
            'name' => 'Nombre',
            'last_name' => 'Apellido',
            'address' => 'Dirección',
            'phone' => 'Teléfono',
            'email' => 'Email',
            'password' => 'Contraseña',
            'role_id' => 'Perfil'
        ];

        return $request->validate([
                    'name' => 'required',
                    'last_name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                    'email' => !is_null($request->input('id')) ? 'required|email|unique:users,email,' . $user->id : 'required|email|unique:users',
                    'password' => !is_null($request->input('id')) && $user->password ? 'nullable|min:6' : 'required|min:6',
                    'role_id' => 'required'
                        ], [], $niceNames);
    }

    private function save($request, $user) {


        $company = Auth::user()->company;
        $user->company_id = $company->id;
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');

        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        //Imagen de perfil
        $picture = UploadBase64::image($request->input('image_base_64'));
        if ($picture) {
            $user->picture = $picture;
        }
        $user->save();

        $user->bodegas()->sync($request->input('bodegas') ?? [] );
    }

}
