<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use App\Models\Rack;
use App\Models\Ubication;
use App\Models\Section;
use App\Helpers\Alias;
use App\Repositories\UbicationRepository;

class RackController extends Controller {

    public function edit(Request $request, $bodega_id, $id) {

        $rack = Rack::where('bodega_id', $bodega_id)
                ->where('id', $id)
                ->firstOrFail();

        $view = view('pages.racks.form', compact('rack', 'bodega_id'))->render();
        return response()->json([
                    'view' => $view
        ]);
    }

    public function update(Request $request, $bodega_id, $id) {


        $rack = Rack::where('bodega_id', $bodega_id)
                ->where('id', $id)
                ->firstOrFail();

        $this->formValidate($request);
        $this->save($request, $rack);

        $bodega = Bodega::with('sections.rack')->find($bodega_id);
        $viewSections = view('pages.sections._sub.sections', compact('bodega'))->render();

        return response()->json([
                    'message' => 'Rack actualizado correctamente',
                    'viewSections' => $viewSections
        ]);
    }

    private function formValidate($request) {
        $niceNames = [
            'name' => 'Código',
            'modules' => 'Módulos',
            'levels' => 'Niveles',
            'tons' => 'Toneladas'
        ];

        return $request->validate([
                    'name' => 'required',
                    'modules' => 'required|numeric|between:0,10',
                    'levels' => 'required|numeric|between:0,10',
                    'tons' => 'required|numeric'
                        ], [], $niceNames);
    }

    private function save($request, $rack) {

        $rack->name = $request->input('name');
        $rack->modules = $request->input('modules');
        $rack->levels = $request->input('levels');
        $rack->ubications = $rack->modules * $rack->levels * 2;
        $rack->tons = $request->input('tons');
        $rack->save();

        $section = Section::where('id', $rack->section_id)->first();
        $section->name = $rack->name;
        $section->save();

        UbicationRepository::updateOrCreateByRack($rack);
    }

}
