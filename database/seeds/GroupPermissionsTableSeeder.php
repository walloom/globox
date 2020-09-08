<?php

use Illuminate\Database\Seeder;
use App\Models\GroupPermission;
use App\Models\Permission;
use App\Models\Action;

class GroupPermissionsTableSeeder extends Seeder {

    public function run() {

        $data = $this->getData();

        foreach ($data as $group):

            $groupPermission = GroupPermission::create([
                        'name' => $group['name']
            ]);

            foreach ($group['permissions'] as $permissionItem):

                $permission = $groupPermission->permissions()->create([
                    'name' => $permissionItem['name'],
                    'is_default' => $permissionItem['is_default'] ?? false
                ]);

                foreach ($permissionItem['actions'] as $actionItem):

                    $action = Action::updateOrCreate([
                                'slug' => $actionItem['slug'],
                                'method' => $actionItem['method']
                    ]);

                    $permission->actions()->attach($action);

                endforeach;

            endforeach;

        endforeach;
    }

    public function getData() {

        return [
            //Home
            [
                'name' => 'Home',
                'permissions' => [
                    [
                        'name' => 'Dashboard',
                        'is_default' => true,
                        'actions' => [
                            [
                                'slug' => 'home',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'settings/save',
                                'method' => 'post'
                            ]
                        ]
                    ]
                ]
            ],
            //Usuarios
            [
                'name' => 'Usuarios',
                'permissions' => [
                    [
                        'name' => 'Listar usuarios',
                        'actions' => [
                            [
                                'slug' => 'empresa/users',
                                'method' => 'get',
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear Usuarios',
                        'actions' => [
                            [
                                'slug' => 'empresa/users/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/users',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar usaurios',
                        'actions' => [
                            [
                                'slug' => 'empresa/users/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/users/*',
                                'method' => 'put'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar usuarios',
                        'actions' => [
                            [
                                'slug' => 'empresa/users/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            //Clientes
            [
                'name' => 'Clientes',
                'permissions' => [
                    [
                        'name' => 'Listar Clientes',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear Clientes',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers',
                                'method' => 'post'
                            ],
                            [
                                'slug' => 'empresa/customers/load-states/*',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers/load-cities/*',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar Clientes',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers/*',
                                'method' => 'put'
                            ],
                            [
                                'slug' => 'empresa/customers/load-states/*',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers/load-cities/*',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Eliminar Clientes',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/*/delete',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ],
                ]
            ],
            //Cátalogos
            [
                'name' => 'Cátalogos',
                'permissions' => [
                    [
                        'name' => 'Listar Cátalogos',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/*/catalogs',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear Cátalogos',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/*/catalogs/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers/*/catalogs',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar Cátalogos',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/*/catalogs/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers/*/catalogs/*',
                                'method' => 'put'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar Cátalogos',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/*/catalogs/*/delete',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/customers/*/catalogs/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Importar Cátalogos',
                        'actions' => [
                            [
                                'slug' => 'empresa/customers/*/catalogs/import',
                                'method' => 'get',
                            ]
                        ]
                    ],
                ]
            ],
            //Bodegas
            [
                'name' => 'Bodegas',
                'permissions' => [
                    [
                        'name' => 'Listar bodegas',
                        'actions' => [
                            [
                                'slug' => 'empresa/bodegas',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear bodegas',
                        'actions' => [
                            [
                                'slug' => 'empresa/bodegas/nueva',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/bodegas/guardar',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar bodegas',
                        'actions' => [
                            [
                                'slug' => 'empresa/bodegas/detalle/*',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/bodegas/detalle/modelado/*',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/bodegas/actualizar/*',
                                'method' => 'post'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar bodegas',
                        'actions' => [
                            [
                                'slug' => 'empresa/bodegas/eliminar/*',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar modelado 2D',
                        'actions' => [
                            [
                                'slug' => 'empresa/bodegas/*/sections',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/bodegas/*/sections/store',
                                'method' => 'post'
                            ],
                            [
                                'slug' => 'empresa/bodegas/*/sections/*/drag',
                                'method' => 'put'
                            ],
                            [
                                'slug' => 'empresa/bodegas/*/racks/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/bodegas/*/racks/*/update',
                                'method' => 'put'
                            ]
                        ]
                    ]
                ]
            ],
            //Unidades
            [
                'name' => 'Unidades',
                'permissions' => [
                    [
                        'name' => 'Listar Unidades',
                        'actions' => [
                            [
                                'slug' => 'empresa/units',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear Unidades',
                        'actions' => [
                            [
                                'slug' => 'empresa/units/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/units',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar Unidades',
                        'actions' => [
                            [
                                'slug' => 'empresa/units/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/units/*',
                                'method' => 'put'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar Unidades',
                        'actions' => [
                            [
                                'slug' => 'empresa/units/*/delete',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/units/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            //Tipos de referencias
            [
                'name' => 'Tipos de referencias',
                'permissions' => [
                    [
                        'name' => 'Listar tipos de referencias',
                        'actions' => [
                            [
                                'slug' => 'empresa/reference-types',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear tipos de referencias',
                        'actions' => [
                            [
                                'slug' => 'empresa/reference-types/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/reference-types',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar tipos de referencias',
                        'actions' => [
                            [
                                'slug' => 'empresa/reference-types/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/reference-types/*',
                                'method' => 'put'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar tipos de referencias',
                        'actions' => [
                            [
                                'slug' => 'empresa/reference-types/*/delete',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/reference-types/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            //Tallas
            [
                'name' => 'Tallas',
                'permissions' => [
                    [
                        'name' => 'Listar tallas',
                        'actions' => [
                            [
                                'slug' => 'empresa/sizes',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear tallas',
                        'actions' => [
                            [
                                'slug' => 'empresa/sizes/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/sizes',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar tallas',
                        'actions' => [
                            [
                                'slug' => 'empresa/sizes/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/sizes/*',
                                'method' => 'put'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar tallas',
                        'actions' => [
                            [
                                'slug' => 'empresa/sizes/*/delete',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/sizes/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            //Presentación
            [
                'name' => 'Presentaciones',
                'permissions' => [
                    [
                        'name' => 'Listar presentaciones',
                        'actions' => [
                            [
                                'slug' => 'empresa/presentations',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear presentación',
                        'actions' => [
                            [
                                'slug' => 'empresa/presentations/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/sizes',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar presentación',
                        'actions' => [
                            [
                                'slug' => 'empresa/presentations/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/presentations/*',
                                'method' => 'put'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar presentación',
                        'actions' => [
                            [
                                'slug' => 'empresa/presentations/*/delete',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/presentations/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            //Presentación
            [
                'name' => 'Pérfiles',
                'permissions' => [
                    [
                        'name' => 'Listar pérfiles',
                        'actions' => [
                            [
                                'slug' => 'empresa/roles',
                                'method' => 'get'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Crear pérfil',
                        'actions' => [
                            [
                                'slug' => 'empresa/roles/create',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/roles',
                                'method' => 'post'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Editar pérfil',
                        'actions' => [
                            [
                                'slug' => 'empresa/roles/*/edit',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/roles/*',
                                'method' => 'put'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Eliminar pérfil',
                        'actions' => [
                            [
                                'slug' => 'empresa/roles/*/delete',
                                'method' => 'get'
                            ],
                            [
                                'slug' => 'empresa/roles/*/destroy',
                                'method' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }

}
