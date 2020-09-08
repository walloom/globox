<?php

namespace App\Repositories;

use App\Models\Rack;
use App\Models\Ubication;

class UbicationRepository {

    public static function updateOrCreateByRack($rack) {

        $ids = [];

        foreach (range(1, $rack->modules) as $module):

            foreach (range(1, $rack->levels) as $level):
                $r = $rack->alias . '-' . $level . '-' . $module . '-R';
                $l = $rack->alias . '-' . $level . '-' . $module . '-L';

                $ubicationR = Ubication::updateOrCreate([
                            'rack_id' => $rack->id,
                            'code' => $r
                                ], [
                            'x' => 3,
                            'y' => 2.5,
                            'z' => 3.4,
                            'kg' => 4
                ]);
                $ids[] = $ubicationR->id;

                $ubicationL = Ubication::updateOrCreate([
                            'rack_id' => $rack->id,
                            'code' => $l
                                ], [
                            'x' => 3,
                            'y' => 2.5,
                            'z' => 3.4,
                            'kg' => 4
                ]);

                $ids[] = $ubicationL->id;

            endforeach;

        endforeach;

        Ubication::where('rack_id', $rack->id)
                ->whereNotIn('id', $ids)
                ->delete();
    }

}
