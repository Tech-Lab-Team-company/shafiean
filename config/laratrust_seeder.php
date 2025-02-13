<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            "employee" => 'c,r,u,d',
            "courses" => 'c,r,u,d',
            "groups" => 'c,r,u,d',
            "groups_exams" => 'c,r,u,d',
            "organizations_sessions" => 'c,r,u,d',
            "organizations_group_student" => 'c,r,u,d',
            "organizations_main_sessions" => 'c,r,u,d',
            "exam_results" => 'c,r,u,d',
            "exams" => 'c,r,u,d',
            "admin_session" => 'c,r,u,d',
            "student" => 'c,r,u,d',
            "teachers" => 'c,r,u,d',
            "relationships" => 'c,r,u,d',
            "job_type" => 'c,r,u,d',
            "headers" => 'c,r,u,d',
            "statistics" => 'c,r,u,d',
            "screens" => 'c,r,u,d',
            "opinions" => 'c,r,u,d',
            "subheaders" => 'c,r,u,d',
            "services" => 'c,r,u,d',
            "partners" => 'c,r,u,d',
            "service_features" => 'c,r,u,d',
            "application_info" => 'c,r,u,d',
            "blogs" => 'c,r,u,d',
            "blogs_categories" => 'c,r,u,d',
            "blogs_hashtags" => 'c,r,u,d',
            "libraries" => 'c,r,u,d',
            "libraries_categories" => 'c,r,u,d',
            "subscripe_group" => 'c,r,u,d',
            "general_setting" => 'c,r,u,d',
            "contact" => 'c,r,u,d',
            "premisson" => 'c,r,u,d',
            "app_info_student" => 'c,r,u,d',
            "app_info_teacher" => 'c,r,u,d',
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
        'role_name' => [
            'module_1_name' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
