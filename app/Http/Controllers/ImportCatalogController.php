<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientImport;

class ImportCatalogController extends Controller {

    public function index(Request $request) {

        return view('pages.importCatalogs.index');
    }

    public function store(Request $request) {


        try {
            ClientLoad::truncate();
            Excel::import(new ClientImport, $request->file('file'));
            //$this->sync();

            return response()->json(['success' => true, 'message' => 'Archivo cargado exitosamente']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

}
