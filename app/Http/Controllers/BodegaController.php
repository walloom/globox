<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Bodega;
use App\Models\Company;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CompanyHelper;

class BodegaController extends Controller {

    public function index() {

        $company = Company::find(auth()->user()->company_id);
        $userBodegas = Auth::user()->bodegas->pluck('id');

        $query = Bodega::where('company_id', $company->id)
                ->orderBy('id', 'desc');

        if (Auth::user()->role->key !== 'company') {
            $query->whereIn('id', $userBodegas);
        }


        $bodegas = $query->get();

        return view('pages.bodegas.index', compact('bodegas'));
    }

    public function create() {
        $departamentos = State::where('country_id', 47)->get();
        $cities = City::where('state_id', 776)->get();
        return view('pages.bodegas.create', compact('departamentos', 'cities'));
    }

    public function model($id) {
        $bodega = Bodega::findOrFail($id);
        $className = "success";
        if ($bodega->occupation >= 50 && $bodega->occupation < 90) {
            $className = "warning";
        } else if ($bodega->occupation >= 90) {
            $className = "danger";
        }
        return view('pages.bodegas.modelado', compact('bodega', 'className'));
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|min:3',
            'occupation' => 'required|numeric',
            'notes' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $bodega = new Bodega;
        $bodega->fill($request->all());
        $bodega->company_id = CompanyHelper::id();
        $bodega->state_id = $request->input('state_id');
        $bodega->city_id = $request->input('city_id');
        $bodega->save();

        if ($request->photo) {
            $imageName = 'photo_' . $bodega->id . '.' . request()->photo->getClientOriginalExtension();
            request()->photo->move(public_path('storage/companies/' . CompanyHelper::id() . "/bodegas/"), $imageName);

            $bodega->photo = $imageName;
            $bodega->save();
        }

        Session::flash('message', 'La bodega ha sido creada <strong>SATISFACTORIAMENTE</strong>');
        return redirect()->route('bodegas');
    }

    public function show($id) {
        $bodega = Bodega::findOrFail($id);

        $departamentos = State::where('country_id', 47)->get();
        $cities = City::where('state_id', 776)->get();
        $className = "success";

        if ($bodega->occupation >= 50 && $bodega->occupation < 90) {
            $className = "warning";
        } else if ($bodega->occupation >= 90) {
            $className = "danger";
        }
        return view('pages.bodegas.show', compact('bodega', 'className', 'departamentos', 'cities'));
    }

    public function edit(Bodega $bodega) {
        //
    }

    public function update(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|min:3',
            'occupation' => 'required|numeric',
            'notes' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);


        // Update user
        $bodega = Bodega::findOrFail($id);
        $bodega->fill($request->all());
        $bodega->company_id = CompanyHelper::id();
        $bodega->state_id = $request->input('state_id');
        $bodega->city_id = $request->input('city_id');
        $bodega->save();

        if ($request->photo) {
            $imageName = 'photo_' . $bodega->id . '.' . request()->photo->getClientOriginalExtension();
            request()->photo->move(public_path('storage/companies/' . CompanyHelper::id() . "/bodegas/"), $imageName);
            $bodega->photo = $imageName;
        }

        $bodega->save();

        Session::flash('message', 'La bodega ha sido actualizada <strong>satisfactoriamente</strong>');
        return redirect()->route('detalleBodega', $bodega->id);
    }

    public function destroy($id) {
        $company = Company::findOrfail(auth()->user()->company_id);
        $bodega = Bodega::findOrfail($id);
        if ($company->id === $bodega->company_id) {
            $bodega->delete();
            Session::flash('message', 'La bodega ha sido eliminada <strong>SATISFACTORIAMENTE</strong>');
            return redirect()->route('bodegas');
        } else {
            Session::flash('message', 'Hemos detectado un comportamiento inusual en tu cuenta, hemos notificado al administrador del sistema para tomar las <strong>MEDIDAS</strong> correspondientes.');
            return redirect()->route('bodegas');
        }
    }

}
