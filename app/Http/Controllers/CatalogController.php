<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CompanyHelper;
use App\Models\Catalog;
use App\Models\Customer;
use App\Models\Size;
use App\Models\Unit;
use App\Models\ReferenceType;

class CatalogController extends Controller {

    public function index(Request $request, $customer_id) {

        $customer = Customer::with('country', 'state', 'city', 'documentType')
                ->where('id', $customer_id)
                ->where('company_id', CompanyHelper::id())
                ->findOrFail($customer_id);

        $search = $request->get('search');

        $query = Catalog::with('customer', 'size')
                ->where('customer_id', $customer_id)
                ->where('company_id', CompanyHelper::id())
                ->orderBy('id', 'desc');

        if ($search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
                $sub->orWhere('ean', 'like', '%' . $search . '%');
            });
        }

        $catalogs = $query->paginate(10);


        return view('pages.catalogs.index', compact('customer_id', 'customer', 'catalogs', 'search'));
    }

    public function create(Request $request, $customer_id) {

        $sizes = Size::where('company_id', CompanyHelper::id())
                ->orderBy('description', 'asc')
                ->get();

        $units = Unit::where('company_id', CompanyHelper::id())
                ->orderBy('description', 'asc')
                ->get();

        $referenceTypes = ReferenceType::where('company_id', CompanyHelper::id())
                ->orderBy('description', 'asc')
                ->get();

        return view('pages.catalogs.create', compact(
                        'customer_id',
                        'sizes',
                        'units',
                        'referenceTypes'
        ));
    }

    public function store(Request $request, $customer_id) {

        $catalog = new Catalog();
        $this->formValidate($request, $catalog);
        $this->save($request, $customer_id, $catalog);

        return redirect('empresa/customers/' . $customer_id . '/catalogs')->with('message', 'Artículo creado correctamente');
    }

    public function edit(Request $request, $customer_id, $id) {

        $sizes = Size::where('company_id', CompanyHelper::id())
                ->orderBy('description', 'asc')
                ->get();

        $units = Unit::where('company_id', CompanyHelper::id())
                ->orderBy('description', 'asc')
                ->get();

        $referenceTypes = ReferenceType::where('company_id', CompanyHelper::id())
                ->orderBy('description', 'asc')
                ->get();

        $catalog = Catalog::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();


        return view('pages.catalogs.edit', compact(
                        'catalog',
                        'customer_id',
                        'sizes',
                        'units',
                        'referenceTypes'
        ));
    }

    public function update(Request $request, $customer_id, $id) {

        $catalog = Catalog::where('customer_id', $customer_id)
                ->where('id', $id)
                ->firstOrFail();

        $this->formValidate($request, $catalog);
        $this->save($request, $customer_id, $catalog);

        return redirect('empresa/customers/' . $customer_id . '/catalogs')->with('message', 'Artículo actualizado correctamente');
    }

    private function formValidate($request, $catalog) {

        $niceNames = [
            'name' => 'Nombre',
            'ena' => 'Ean',
            'plu' => 'PLU'
        ];

        return $request->validate([
                    'name' => 'required',
                    'ean' => 'required',
                        ], [], $niceNames);
    }

    private function save($request, $customer_id, $catalog) {

        $catalog->company_id = CompanyHelper::id();
        $catalog->customer_id = $customer_id;
        $catalog->name = $request->input('name');
        $catalog->ean = $request->input('ean');
        $catalog->plu = $request->input('plu');
        $catalog->size_id = $request->input('size_id');
        $catalog->presentation_id = $request->input('presentation_id');
        $catalog->color_id = $request->input('color_id');
        $catalog->dimension = $request->input('dimension');
        $catalog->reference_type_id = $request->input('reference_type_id');
        $catalog->active = $request->input('active');
        //
        $catalog->catalog_category_id = $request->input('catalog_category_id');
        $catalog->catalog_class_id = $request->input('catalog_class_id');
        $catalog->catalog_type_id = $request->input('catalog_type_id');
        $catalog->standar = $request->input('standar');
        $catalog->standard_cost = $request->input('standard_cost');
        $catalog->last_cost = $request->input('last_cost');
        $catalog->average_cost = $request->input('average_cost');
        $catalog->opening_date = $request->input('opening_date');
        //
        $catalog->unit_one_id = $request->input('unit_one_id');
        $catalog->quantity_unit_one = $request->input('quantity_unit_one');
        $catalog->unit_two_id = $request->input('unit_two_id');
        $catalog->quantity_unit_two = $request->input('quantity_unit_two');
        $catalog->priority = $request->input('priority');
        $catalog->weight = $request->input('weight');
        $catalog->volume = $request->input('volume');
        $catalog->stock_min = $request->input('stock_min');
        $catalog->stock_max = $request->input('stock_max');

        $catalog->save();
    }

    public function delete(Request $request, $customer_id, $id) {

        $catalog = Catalog::where('company_id', CompanyHelper::id())
                ->where('customer_id', $customer_id)
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.catalogs.delete', compact('catalog', 'customer_id'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function destroy(Request $request, $customer_id, $id) {

        $catalog = Catalog::where('company_id', CompanyHelper::id())
                ->where('customer_id', $customer_id)
                ->where('id', $id)
                ->firstOrFail();
        $catalog->delete();

        $view = $this->viewTable($request, $customer_id);
        return response()->json([
                    'message' => 'Artículo eliminada correctamente',
                    'view' => $view
        ]);
    }

    private function viewTable(Request $request, $customer_id, $filter = true) {

        parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
        $search = $queries['search'] ?? null;
        $page = $queries['page'] ?? null;

        $query = Catalog::with('customer', 'size')
                ->where('customer_id', $customer_id)
                ->where('company_id', CompanyHelper::id())
                ->orderBy('id', 'desc');

        $customer = Customer::with('country', 'state', 'city', 'documentType')
                ->where('id', $customer_id)
                ->where('company_id', CompanyHelper::id())
                ->firstOrFail();

        if ($filter && $search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
                $sub->orWhere('ean', 'like', '%' . $search . '%');
            });
        }

        $search = !$filter ? null : $search;
        $page = !$filter ? null : $page;

        $catalogs = $query->paginate(10, ['*'], 'page', $page);
        $catalogs->setPath('empresa/customers/' . $customer_id . '/catalogs');

        return view('pages.catalogs.table', compact('customer_id', 'customer', 'catalogs', 'search'))->render();
    }

}
