<?php

return [

//    'evaluation_criteria' => [
//        'services'    => 'Service',
//        'appearrance' => 'Erscheinung',
//        'punctuality' => 'Pünktlichkeit',
//    ],
//
//    'types_of_contract' => [
//        ''      => 'Personalüberlassungsvertrag',
////        '' => 'Dienstvertrag',
////        '' => 'Werkvertrag',
//        'other' => 'Sonstiges',
//    ],

    'payroll_relevant_factors' => [
        'contractual_penalties' => [
            'name' => 'Vertragsstrafe',
            'sign' => '-1'
        ],
        'tool'                  => [
            'name' => 'Werkzeug',
            'sign' => '-1'
        ],
        'part_payment'          => [
            'name' => 'Abschlag',
            'sign' => '-1'
        ],
        'advance_payment'       => [
            'name' => 'Vorschuss',
            'sign' => '-1'
        ],
        'travel_expenses'       => [
            'name' => 'Fahrtkosten',
            'sign' => '+1'
        ],
        'refund'       => [
            'name' => 'Erstattung',
            'sign' => '+1'
        ],
        'bonus'       => [
            'name' => 'Bonus',
            'sign' => '+1'
        ]
    ],

    'extra_business' => [
        'training' => [
            'name'       => 'Schulung',
            'multiplier' => '1'
        ],
        'disposal' => [
            'name'       => 'Disposition',
            'multiplier' => '1'
        ],
        'back_office' => [
            'name'       => 'Back-Office',
            'multiplier' => '1'
        ],
        'holiday_premium_half' => [
            'name'       => 'Feiertagszuschlag 50 %',
            'multiplier' => '0.5'
        ],
        'holiday_premium_full' => [
            'name'       => 'Feiertagszuschlag 100 %',
            'multiplier' => '1'
        ]
    ],

    'staff_cost_factor' => [
        'temporary' => 1.35,
        'part_time' => 1.25,
        'full_time' => 1.2,
    ],

    'locations' => [
        'Bonn',
        'Köln',
        'Düsseldorf'
    ],

    'usertypes' => [
        'internal' => 'Intern',
        'employee' => 'Mitarbeiter',
        'client'   => 'Kunde'
    ],

    'roles' => [
        'CK' => 'Cashkellner',
        'TL' => 'Teamleiter',
        'SR' => 'Service'
    ],

    'months' => [
        1  => 'Januar',
        2  => 'Februar',
        3  => 'März',
        4  => 'April',
        5  => 'Mai',
        6  => 'Juni',
        7  => 'Juli',
        8  => 'August',
        9  => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Dezember',
    ]

];
