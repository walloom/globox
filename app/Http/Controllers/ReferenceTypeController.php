<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CompanyHelper;
use App\Models\ReferenceType;

class ReferenceTypeController extends Controller {

    public function index(Request $request) {

        $search = $request->get('search');

        $query = ReferenceType::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($search) {
            $query->where(function($sub) use ($search) {
                $sub->where('code', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $referenceTypes = $query->paginate(10);

        return view('pages.referenceTypes.index', compact('referenceTypes', 'search'));
    }

    public function create() {
        $view = view('pages.referenceTypes.form')->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function store(Request $request) {

        $referenceType = new ReferenceType();
        $this->formValidate($request);
        $this->save($request, $referenceType);

        $view = $this->viewTable($request, false);
        return response()->json([
                    'message' => 'Tipo de referencia creada correctamente',
                    'view' => $view
        ]);
    }

    public function edit(Request $request, $id) {
        $referenceType = ReferenceType::find($id);
        $view = view('pages.referenceTypes.form', compact('referenceType'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function update(Request $request, $id) {

        $referenceType = ReferenceType::find($id);
        $this->formValidate($request);
        $this->save($request, $referenceType);

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Tipo de referencia actualizada correctamente',
                    'view' => $view
        ]);
    }

    private function formValidate($request) {
        $niceNames = [
            'name' => 'Código',
        ];

        return $request->validate([
                    'code' => 'required'
                        ], [], $niceNames);
    }

    private function save($request, $referenceType) {
        $referenceType->code = $request->input('code');
        $referenceType->description = $request->input('description');
        $referenceType->company_id = CompanyHelper::id();
        $referenceType->save();
    }

    private function viewTable(Request $request, $filter = true) {

        parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
        $search = $queries['search'] ?? null;
        $page = $queries['page'] ?? null;

        $query = ReferenceType::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($filter && $search) {
            $query->where(function($sub) use ($search) {
                $sub->where('code', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $search = !$filter ? null : $search;
        $page = !$filter ? null : $page;

        $referenceTypes = $query->paginate(10, ['*'], 'page', $page);
        $referenceTypes->setPath('empresa/reference-types');

        return view('pages.referenceTypes.table', compact('referenceTypes', 'search'))->render();
    }

    public function delete(Request $request, $id) {

        $referenceType = ReferenceType::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.referenceTypes.delete', compact('referenceType'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function destroy(Request $request, $id) {

        $referenceType = ReferenceType::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $referenceType->delete();

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Tipo de referencia eliminada correctamente',
                    'view' => $view
        ]);
    }

}
