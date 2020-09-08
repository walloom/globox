<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presentation;
use App\Helpers\CompanyHelper;

class PresentationController extends Controller {

    public function index(Request $request) {

        $search = $request->get('search');

        $query = Presentation::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $presentations = $query->paginate(10);

        return view('pages.presentations.index', compact('presentations', 'search'));
    }

    public function create() {
        $view = view('pages.presentations.form')->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function store(Request $request) {

        $presentation = new Presentation();
        $this->formValidate($request);
        $this->save($request, $presentation);

        $view = $this->viewTable($request, false);
        return response()->json([
                    'message' => 'Presentación creada correctamente',
                    'view' => $view
        ]);
    }

    public function edit(Request $request, $id) {
        $presentation = Presentation::find($id);
        $view = view('pages.presentations.form', compact('presentation'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function update(Request $request, $id) {

        $presentation = Presentation::find($id);
        $this->formValidate($request);
        $this->save($request, $presentation);

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Presentación actualizada correctamente',
                    'view' => $view
        ]);
    }

    private function formValidate($request) {
        $niceNames = [
            'name' => 'Nombre',
        ];

        return $request->validate([
                    'name' => 'required'
                        ], [], $niceNames);
    }

    private function save($request, $presentation) {
        $presentation->name = $request->input('name');
        $presentation->description = $request->input('description');
        $presentation->company_id = CompanyHelper::id();
        $presentation->save();
    }

    private function viewTable(Request $request, $filter = true) {

        parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
        $search = $queries['search'] ?? null;
        $page = $queries['page'] ?? null;

        $query = Presentation::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($filter && $search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $search = !$filter ? null : $search;
        $page = !$filter ? null : $page;

        $presentations = $query->paginate(10, ['*'], 'page', $page);
        $presentations->setPath('empresa/presentations');

        return view('pages.presentations.table', compact('presentations', 'search'))->render();
    }

    public function delete(Request $request, $id) {

        $presentation = Presentation::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.presentations.delete', compact('presentation'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function destroy(Request $request, $id) {

        $presentation = Presentation::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $presentation->delete();

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Presentación eliminada correctamente',
                    'view' => $view
        ]);
    }

}
