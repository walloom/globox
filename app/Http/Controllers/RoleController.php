<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\GroupPermission;
use App\Models\Permission;
use App\Helpers\CompanyHelper;
use Illuminate\Support\Str;

class RoleController extends Controller {

    public function index(Request $request) {

        $search = $request->get('search');

        $query = Role::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
            });
        }
        $roles = $query->paginate(10);
        return view('pages.roles.index', compact('roles', 'search'));
    }

    public function create() {

        $groupPermissions = GroupPermission::with('permissions')
                ->get();
        
        return view('pages.roles.create', compact('groupPermissions'));
    }

    public function store(Request $request) {

        $role = new Role();
        $this->formValidate($request, $role);
        $this->save($request, $role);
        return redirect('empresa/roles');
    }

    public function edit(Request $request, $id) {

        $role = Role::with('permissions')->find($id);
        $groupPermissions = GroupPermission::with('permissions')
                ->get();
        
        return view('pages.roles.edit', compact('role', 'groupPermissions'));
    }

    public function update(Request $request, $id) {

        $role = Role::where('company_id', CompanyHelper::id())->where('id', $id)->firstOrFail();
        $this->formValidate($request, $role);
        $this->save($request, $role);
        return redirect('empresa/roles');
    }

    private function formValidate($request, $role) {

        $niceNames = [
            'name' => 'Nombre',
        ];
        return $request->validate([
                    'name' => 'required'
                        ], [], $niceNames);
    }

    private function save($request, $role) {
        $role->name = $request->input('name');
        $role->key = Str::slug($role->name);
        $role->company_id = CompanyHelper::id();
        $role->save();
        $role->permissions()->sync($request->input('permisions'));
        $role->permissions()->syncWithoutDetaching([1]);
        
    }

    public function delete(Request $request, $id) {

        $role = Role::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.roles.delete', compact('role'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function destroy(Request $request, $id) {

        $role = Role::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();
        
        $role->permissions()->detach();
        $role->delete();

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Pérfil eliminado correctamente',
                    'view' => $view
        ]);
    }

    private function viewTable(Request $request, $filter = true) {

        parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
        $search = $queries['search'] ?? null;
        $page = $queries['page'] ?? null;

        $query = Role::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($filter && $search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
            });
        }

        $search = !$filter ? null : $search;
        $page = !$filter ? null : $page;

        $roles = $query->paginate(10, ['*'], 'page', $page);
        $roles->setPath('empresa/roles');

        return view('pages.roles.table', compact('roles', 'search'))->render();
    }

}
