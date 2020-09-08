<?php

namespace App\Helpers;

class Form {

    public static function isChecked($column, $item, $colletion = null) {
        
        $checked = false;
        
        if($item->is_default){
            return true;
        }
        
        if (old($column)) {
            $array = old($column);
            foreach ($array as $item):
                if ($item == $item->id) {
                    $checked = true;
                    break;
                }
            endforeach;
            return $checked;
        }

        if (!is_null($colletion)) {
            foreach ($colletion as $coll):
                if (isset($coll->id) && $coll->id == $item->id) {
                    $checked = true;
                    break;
                }
            endforeach;
        }
        return $checked;
    }

}
