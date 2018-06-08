<?php

return [

    'super_user' => [
        'name' => 'Admin',
        'email' => 'admin@mcu.edu.ng',
        'password' => 'secret',
        'role'  => 5
    ],
    'colleges' => [
        ['name' => 'College of Humanities', 'shortname' => 'colhum'],
        ['name' => 'College of Natural and Applied Sciences', 'shortname' => 'colnas'],
        ['name' => 'College of Social and Management Sciences', 'shortname' => 'cosmas'],
    ],
    'departments' => [
        ['college_id' => 2, 'name' => 'Physical and Computer Sciences'], #1
        ['college_id' => 2, 'name' => 'Biological Sciences'], #2
        ['college_id' => 1, 'name' => 'History and International Studies'], #3
        ['college_id' => 1, 'name' => 'English'], #4
        ['college_id' => 1, 'name' => 'Religious Studies'], #5
        ['college_id' => 3, 'name' => 'Economics'], #6
        ['college_id' => 3, 'name' => 'Accounting and Finance'], #7
        ['college_id' => 3, 'name' => 'Business Administration'], #8
        ['college_id' => 3, 'name' => 'International Relations'], #9
    ],
    'programs' => [
        ['department_id' => 1, 'name' => 'Computer Science'],
        ['department_id' => 1, 'name' => 'Statistics'],
        ['department_id' => 1, 'name' => 'Physics'],
        ['department_id' => 1, 'name' => 'Mathematics'],
        ['department_id' => 2, 'name' => 'Biology'],
        ['department_id' => 2, 'name' => 'Biochemistry'],
        ['department_id' => 2, 'name' => 'Biotechnology'],
        ['department_id' => 3, 'name' => 'History and International Studies'],
        ['department_id' => 4, 'name' => 'English Language'],
        ['department_id' => 5, 'name' => 'Religious Studies'],
        ['department_id' => 6, 'name' => 'Economics'],
        ['department_id' => 7, 'name' => 'Accounting and Finance'],
        ['department_id' => 8, 'name' => 'Business Administration'],
        ['department_id' => 9, 'name' => 'International Relations'],
    ]

];