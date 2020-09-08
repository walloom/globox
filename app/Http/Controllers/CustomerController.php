<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Helpers\CompanyHelper;
use App\Helpers\UploadBase64;
//
use App\Models\DocumentType;
use App\Models\EconomicActivity;
use App\Models\Currency;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CustomerController extends Controller {

    public function index(Request $request) {

        $search = $request->get('search');

        $query = Customer::with('country', 'state')
                ->where('company_id', CompanyHelper::id())
                ->orderBy('id', 'desc');

        if ($search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
                $sub->orWhere('identification', 'like', '%' . $search . '%');
            });
        }
        $customers = $query->paginate(10);

        return view('pages.customers.index', compact('customers', 'search'));
    }

    public function create(Request $request) {

        $documentTypes = DocumentType::orderBy('code', 'asc')->get();
        $economicActivities = EconomicActivity::orderBy('name', 'asc')->get();
        $currencies = Currency::orderBy('name', 'asc')->get();

        $countries = Country::orderBy('name', 'asc')->get();
        $states = $this->getStates();
        $cities = $this->getCities();

        return view('pages.customers.create', compact(
                        'documentTypes',
                        'economicActivities',
                        'currencies',
                        'countries',
                        'states',
                        'cities'
        ));
    }

    public function store(Request $request) {

        $customer = new Customer();
        $this->formValidate($request, $customer);
        $this->save($request, $customer);

        return redirect('empresa/customers')->with('message', 'Cliente creado correctamente');
    }

    public function edit(Request $request, $id) {

        $customer = Customer::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $documentTypes = DocumentType::orderBy('code', 'asc')->get();
        $economicActivities = EconomicActivity::orderBy('name', 'asc')->get();
        $currencies = Currency::orderBy('name', 'asc')->get();

        $countries = Country::orderBy('name', 'asc')->get();
        $states = $this->getStates($customer);
        $cities = $this->getCities($customer);

        return view('pages.customers.edit', compact(
                        'customer',
                        'documentTypes',
                        'economicActivities',
                        'currencies',
                        'countries',
                        'states',
                        'cities'
        ));
    }

    public function update(Request $request, $id) {

        $customer = Customer::find($id);
        $this->formValidate($request, $customer);
        $this->save($request, $customer);

        return redirect('empresa/customers')->with('message', 'Cliente actualizado correctamente');
    }

    private function formValidate($request, $customer) {

        $niceNames = [
            'name' => 'Nombre',
            'document_type_id' => 'Tipo de documento',
            'identification' => 'Número de documento',
            'country_id' => 'País',
            'state_id' => 'Departamento',
            'city_id' => 'Ciudad',
            'zone' => 'Zona',
            'cell_number' => 'Celular',
            'phone_number' => 'Teléfono',
            'address' => 'Dirección',
            'economic_activity_id' => 'Actividad económica',
            'currency_id' => 'Moneda'
        ];

        return $request->validate([
                    'name' => 'required',
                    'document_type_id' => 'required',
                    'identification' => 'required',
                    'country_id' => 'required',
                    'state_id' => 'required',
                    'city_id' => 'required',
                    'zone' => 'required',
                    'cell_number' => 'required',
                    'phone_number' => 'required',
                    'address' => 'required',
                    'economic_activity_id' => 'required',
                    'currency_id' => 'required'
                        ], [], $niceNames);
    }

    private function save($request, $customer) {

        $customer->company_id = CompanyHelper::id();
        $customer->name = $request->input('name');
        $customer->document_type_id = $request->input('document_type_id');
        $customer->identification = $request->input('identification');
        $customer->country_id = $request->input('country_id');
        $customer->state_id = $request->input('state_id');
        $customer->city_id = $request->input('city_id');
        $customer->zone = $request->input('zone');
        $customer->cell_number = $request->input('cell_number');
        $customer->phone_number = $request->input('phone_number');
        $customer->address = $request->input('address');
        $customer->economic_activity_id = $request->input('economic_activity_id');
        $customer->currency_id = $request->input('currency_id');

        //Imagen de perfil
        $picture = UploadBase64::image($request->input('image_base_64'), 'customers');
        if ($picture) {
            $customer->picture = $picture;
        }

        $customer->save();
    }

    public function loadStates(Request $request, $id) {

        $states = State::where('country_id', $id)->orderBy('name', 'asc')->get();

        $viewStates = view('pages.customers._sub.states', compact('states'))->render();
        $viewCities = view('pages.customers._sub.cities')->render();

        return response()->json([
                    'viewStates' => $viewStates,
                    'viewCities' => $viewCities
        ]);
    }

    public function loadCities(Request $request, $id) {

        $cities = City::where('state_id', $id)->orderBy('name', 'asc')->get();
        $viewCities = view('pages.customers._sub.cities', compact('cities'))->render();

        return response()->json([
                    'viewCities' => $viewCities
        ]);
    }

    private function getStates($customer = null) {

        $states = null;
        if (old('country_id')) {
            $states = State::where('country_id', old('country_id'))->orderBy('name', 'asc')->get();
        }
        if (!old('country_id') && isset($customer->country_id)) {
            $states = State::where('country_id', $customer->country_id)->orderBy('name', 'asc')->get();
        }
        return $states;
    }

    private function getCities($customer = null) {

        $cities = null;
        if (old('state_id')) {
            $cities = City::where('state_id', old('state_id'))->orderBy('name', 'asc')->get();
        }
        if (!old('state_id') && isset($customer->state_id)) {
            $cities = City::where('state_id', $customer->state_id)->orderBy('name', 'asc')->get();
        }
        return $cities;
    }

    public function delete(Request $request, $id) {

        $customer = Customer::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.customers.delete', compact('customer'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function destroy(Request $request, $id) {

        $customer = Customer::where('company_id', CompanyHelper::id())
                ->where('id', $id)
                ->firstOrFail();
        $customer->delete();

        $view = $this->viewTable($request);
        return response()->json([
                    'message' => 'Unidad de Medida eliminada correctamente',
                    'view' => $view
        ]);
    }

    private function viewTable(Request $request, $filter = true) {

        parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
        $search = $queries['search'] ?? null;
        $page = $queries['page'] ?? null;

        $query = Customer::with('country', 'state')
                ->where('company_id', CompanyHelper::id())
                ->orderBy('id', 'desc');

        if ($filter && $search) {
            $query->where(function($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%');
                $sub->orWhere('identification', 'like', '%' . $search . '%');
            });
        }

        $search = !$filter ? null : $search;
        $page = !$filter ? null : $page;

        $customers = $query->paginate(10, ['*'], 'page', $page);
        $customers->setPath('empresa/customers');

        return view('pages.customers.table', compact('customers', 'search'))->render();
    }

}
