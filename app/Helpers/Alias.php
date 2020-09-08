<?php

namespace App\Helpers;

use App\Models\Bodega;

class Alias {

    public static function get($bodegaId, $type) {

        $bodega = Bodega::with(['sections' => function($s)use($type) {
                        $s->where('type', $type);
                    }])
                ->where('id', $bodegaId)
                ->first();

        $aliasArray = [];
        if (isset($bodega->sections)) {
            $aliasArray = $bodega->sections->pluck('alias')->toArray();
        }

        return self::getAliasLetter($aliasArray);
    }

    private static function getAliasLetter($aliasArray) {

        $keys = [];
        $letter = null;

        for ($i = 'A'; $i < 'ZZ'; $i++):
            $keys[] = $i;
        endfor;

        foreach ($keys as $key):
            if (!in_array($key, $aliasArray)) {
                $letter = $key;
                break;
            }
        endforeach;

        return $letter;
    }

}
