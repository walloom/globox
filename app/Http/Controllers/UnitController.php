<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Helpers\CompanyHelper;

class UnitController extends Controller {

    public function index(Request $request) {

        $search = $request->get('search');

        $query = Unit::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($search) {
            $query->where(function($sub) use ($search) {
                $sub->where('code', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $units = $query->paginate(10);

        return view('pages.units.index', compact('units', 'search'));
    }

    public function create() {
        $view = view('pages.units.form')->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function store(Request $request) {

        $unit = new Unit();
        $this->formValidate($request);
        $this->save($request, $unit);

        $view = $this->viewTable($request, false);
        return response()->json([
                    'message' => 'Unidad de Medida creada correctamente',
                    'view' => $view
        ]);
    }

    public function edit(Request $request, $id) {
        $unit = Unit::find($id);
        $view = view('pages.units.form', compact('unit'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function update(Request $request, $id) {

        $unit = Unit::find($id);
        $this->formValidate($request);
        $this->save($request, $unit);

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Unidad de Medida actualizada correctamente',
                    'view' => $view
        ]);
    }

    private function formValidate($request) {
        $niceNames = [
            'code' => 'Código',
        ];

        return $request->validate([
                    'code' => 'required'
                        ], [], $niceNames);
    }

    private function save($request, $unit) {
        $unit->code = $request->input('code');
        $unit->description = $request->input('description');
        $unit->company_id = CompanyHelper::id();
        $unit->save();
    }

    private function viewTable(Request $request, $filter = true) {

        parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
        $search = $queries['search'] ?? null;
        $page = $queries['page'] ?? null;

        $query = Unit::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($filter && $search) {
            $query->where(function($sub) use ($search) {
                $sub->where('code', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $search = !$filter ? null : $search;
        $page = !$filter ? null : $page;

        $units = $query->paginate(10, ['*'], 'page', $page);
        $units->setPath('empresa/units');

        return view('pages.units.table', compact('units', 'search'))->render();
    }

    public function delete(Request $request, $id) {

        $unit = Unit::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.units.delete', compact('unit'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function destroy(Request $request, $id) {

        $unit = Unit::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $unit->delete();

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Unidad de Medida eliminada correctamente',
                    'view' => $view
        ]);
    }

}
