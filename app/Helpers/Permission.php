<?php

namespace App\Helpers;

class Permission {

    public static function action($pAction) {


        $permissions = auth()->user()->role->permissions;
        $permissions->load(['actions']);
        $actions = [];

        foreach ($permissions as $permission):
            foreach ($permission->actions as $action):
                $actions[] = [
                    'slug' => $action->slug,
                    'method' => $action->method
                ];
            endforeach;
        endforeach;

        $active = false;

        foreach ($actions as $action):

            if (!$active && is_array($pAction) && in_array($action['slug'], $pAction)) {
                $active = true;
                break;
            }

            if (!$active && !is_array($pAction) && $pAction === $action['slug']) {
                $active = true;
                break;
            }
        endforeach;

        return $active;
    }

    public static function disabled($pAction) {
        if (self::action($pAction)) {
            return '';
        }
        return 'disabled';
    }

}
