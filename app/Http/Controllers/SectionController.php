<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use App\Models\Section;
use App\Models\Rack;
use App\Models\Ubication;
use App\Helpers\Alias;
use App\Repositories\UbicationRepository;

class SectionController extends Controller {

    public function index(Request $request, $bodega_id) {

        $bodega = Bodega::with('sections.rack')
                ->find($bodega_id);
        return view('pages.sections.index', compact('bodega'));
    }

    public function store(Request $request, $bodega_id) {

        $type = $request->input('type');
        $letter = Alias::get($bodega_id, $type);
        $name = 'Rack';
        $name = $type == 'separator' ? 'Pasillo' : $name;
        $name = $type == 'door' ? 'Puerta' : $name;

        $section = Section::create([
                    'bodega_id' => $bodega_id,
                    'name' => $name . ' ' . $letter,
                    'alias' => $letter,
                    'x' => $request->input('x'),
                    'y' => $request->input('y'),
                    'w' => $request->input('w'),
                    'h' => $request->input('h'),
                    'type' => $type
        ]);

        if ($section->type === 'rack'):

            $rack = Rack::create([
                        'bodega_id' => $bodega_id,
                        'section_id' => $section->id,
                        'name' => $section->name,
                        'alias' => $section->alias,
                        'levels' => 3,
                        'modules' => 3,
                        'ubications' => 18,
                        'tons' => 1
            ]);
            $section->load('rack');
            UbicationRepository::updateOrCreateByRack($rack);


        endif;



        return response()->json($section);
    }

    public function drag(Request $request, $bodega_id, $id) {

        $section = Section::where('bodega_id', $bodega_id)
                ->where('id', $id)
                ->firstOrFail();

        $section->update([
            'x' => $request->input('x'),
            'y' => $request->input('y'),
            'w' => $request->input('w'),
            'h' => $request->input('h')
        ]);
    }

}
