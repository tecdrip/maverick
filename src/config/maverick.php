<?php

// Maverick Config
return [
    /* 
        Form Models 

        Models Maverick will use to generate forms
    */ 
    'models' => [
        'Lead',
        'User',
        'Customer'
    ],
    'column_relationships' => [
        'dealer_id' => App\Dealer::class,
        'store_id' => App\Store::class
    ],
    'column_ordering' => [
        'leads' => [
            ['first_name', 'dealer_id'],
            'email',
        ]
    ]
];
?>