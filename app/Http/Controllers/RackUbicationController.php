<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubication;
use App\Models\Rack;
use App\Models\Bodega;

class RackUbicationController extends Controller {

    public function show(Request $request, $bodega_id, $rack_id, $id) {

        $ubication = Ubication::where('rack_id', $rack_id)
                ->where('id', $id)
                ->first();

        $view = view('pages.rackUbications.show', compact(
                        'ubication',
                        'bodega_id',
                        'rack_id'))
                ->render();

        return response()->json([
                    'view' => $view
        ]);
    }

    public function available(Request $request, $bodega_id, $rack_id, $id) {

        $ubication = Ubication::where('rack_id', $rack_id)
                ->where('id', $id)
                ->first();
        $ubication->available = $request->input('status') === "0" ? false : true;
        $ubication->save();

        $countOc = Ubication::where('rack_id', $rack_id)->where('available', false)->count();
        $countUb = Ubication::where('rack_id', $rack_id)->count();
        $occupation = ($countOc * 100) / $countUb;


        $rack = Rack::where('bodega_id', $bodega_id)->where('id', $rack_id)->firstOrFail();
        $rack->occupation = $occupation;
        $rack->save();

        $viewUbication = view('pages.rackUbications.show', compact('ubication', 'bodega_id', 'rack_id'))->render();
        $viewPreview = view('pages.racks._sub.preview', compact('rack', 'bodega_id'))->render();

        $bodega = Bodega::with('sections.rack')->find($bodega_id);
        $viewSections = view('pages.sections._sub.sections', compact('bodega'))->render();

        return response()->json([
                    'viewUbication' => $viewUbication,
                    'viewPreview' => $viewPreview,
                    'viewSections' => $viewSections
        ]);
    }

}
