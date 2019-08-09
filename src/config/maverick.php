<?php

// Maverick Config
return [
    /* 
        maverick.models

        Models Maverick will use to generate forms
    */ 
    'models' => [
        // User
    ],
    /* 
        maverick.column_relationships

        Define relationship ID's used in Models
        Maverick will use this IDs to generate selects with Model Names instead of inputs for the Models ID
    */ 
    'column_relationships' => [
        // 'user_id' => App\User::class
    ],
    /*
        maverick.column_ordering

        Tell Maverick the correct way to order your Model Forms
        By default its a 2 column grid.
    */
    'column_ordering' => [
        /* 'users' => [
            'name',
            'email',
            ['dealer_id', 'password']
        ], */
    ],
    /*
        maverick.column_override

        Override columns

        Mostly use to turn strings fields into enums
    */
    'column_override' => [
        /*
        'users' => [
            'user_type' => [
                'type' => 'enum',
                'options' => [
                    'admin',
                    'dealer-employee',
                    'dealer-admin'
                ]
            ]
        ]*/
    ]
];
?>