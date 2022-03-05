<?php

return [
    // role
    'role'       => [
        'root' => [
            'ADMIN'    => 'admin',
            'EMPLOYEE' => 'employee',
            'CUSTOMER' => 'customer',
        ],
    ],

    // permission
    'permission' => [
        'group' => [
            'ROLE'     => 'role',
            'ADMIN'    => 'admin',
            'CUSTOMER' => 'customer',
            'PRODUCT'  => 'product',
        ],
    ],

    // attribute
    'attribute'  => [
        'type' => [
            'TEXT'   => 'text',
            'NUMBER' => 'number',
        ],
    ],
];
