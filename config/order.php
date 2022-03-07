<?php

return [
    'type'   => [
        'purchase' => [
            'key'  => 'purchase',
            'name' => 'Purchase',
        ],
        'sale'     => [
            'key'  => 'sale',
            'name' => 'Sale',
        ],
    ],

    'status' => [
        'pending'    => [
            'key'  => 2,
            'name' => 'Pending',
        ],
        'processing' => [
            'key'  => 3,
            'name' => 'Processing',
        ],
        'shipping'   => [
            'key'  => 4,
            'name' => 'Shipping',
        ],
        'completed'  => [
            'key'  => 6,
            'name' => 'Completed',
        ],
        'cancelled'  => [
            'key'  => 7,
            'name' => 'Cancelled',
        ],
    ],
];
