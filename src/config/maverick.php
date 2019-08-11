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

        Maverick will use these ID's to improve the create/update forms
        Models defined here should have an ID and Name field in their table.
    */ 
    'column_relationships' => [
        // 'user_id' => App\User::class
    ],
    /*
        maverick.column_ordering

        Tell Maverick the correct way to order your Model Forms
        Default is a 2 column input grid going down. Using a string in the array tells Mav to only use one input on that row. 
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

        Override column type

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