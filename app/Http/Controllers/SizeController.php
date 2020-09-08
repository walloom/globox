<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Helpers\CompanyHelper;

class SizeController extends Controller {

    public function index(Request $request) {

        $search = $request->get('search');

        $query = Size::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($search) {
            $query->where(function($sub) use ($search) {
                $sub->where('code', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $sizes = $query->paginate(10);

        return view('pages.sizes.index', compact('sizes', 'search'));
    }

    public function create() {
        $view = view('pages.sizes.form')->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function store(Request $request) {

        $size = new Size();
        $this->formValidate($request);
        $this->save($request, $size);

        $view = $this->viewTable($request, false);
        return response()->json([
                    'message' => 'Talla creada correctamente',
                    'view' => $view
        ]);
    }

    public function edit(Request $request, $id) {
        $size = Size::find($id);
        $view = view('pages.sizes.form', compact('size'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function update(Request $request, $id) {

        $size = Size::find($id);
        $this->formValidate($request);
        $this->save($request, $size);

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Talla actualizada correctamente',
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

    private function save($request, $size) {
        $size->code = $request->input('code');
        $size->description = $request->input('description');
        $size->company_id = CompanyHelper::id();
        $size->save();
    }

    private function viewTable(Request $request, $filter = true) {

        parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
        $search = $queries['search'] ?? null;
        $page = $queries['page'] ?? null;

        $query = Size::where('company_id', CompanyHelper::id())->orderBy('id', 'desc');
        if ($filter && $search) {
            $query->where(function($sub) use ($search) {
                $sub->where('code', 'like', '%' . $search . '%');
                $sub->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $search = !$filter ? null : $search;
        $page = !$filter ? null : $page;

        $sizes = $query->paginate(10, ['*'], 'page', $page);
        $sizes->setPath('empresa/sizes');

        return view('pages.sizes.table', compact('sizes', 'search'))->render();
    }

    public function delete(Request $request, $id) {

        $size = Size::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.sizes.delete', compact('size'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function destroy(Request $request, $id) {

        $size = Size::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $size->delete();

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Talla eliminada correctamente',
                    'view' => $view
        ]);
    }

}
