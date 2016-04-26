<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => '訪問管理',

            'permissions' => [
                'all' => '權限列表',
                'create' => '新建權限',
                'edit' => '編輯權限',
                'groups' => [
                    'all' => '權限組列表',
                    'create' => '新建權限組',
                    'edit' => '編輯權限組',
                    'main' => '權限組',
                ],
                'main' => '權限',
                'management' => '權限管理',
            ],

            'roles' => [
                'all' => '角色列表',
                'create' => '新建角色',
                'edit' => '編輯角色',
                'management' => '角色管理',
                'main' => '用戶角色',
            ],

            'users' => [
                'all' => '用戶列表',
                'change-password' => '修改密碼',
                'create' => '新建用戶',
                'deactivated' => '停用用戶',
                'deleted' => '刪除用戶',
                'edit' => '編輯用戶',
                'main' => '用戶',
            ],
        ],

        'log-viewer' => [
            'main' => '日誌查看',
            'dashboard' => '日誌統計',
            'logs' => '日誌列表',
        ],

        'sidebar' => [
            'dashboard' => '儀表看板',
            'general' => '常用功能',
        ],
    ],

    'language-picker' => [
        'language' => '語言',
        /**
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'da' => '丹麥語',
            'de' => '德語',
            'en' => '英語',
            'es' => '西班牙語',
            'fr' => '法語',
            'it' => '意大利語',
            'pt-BR' => '巴西葡萄牙語',
            'sv' => '瑞典語',
            'zh' => '繁體中文',
        ],
    ],
];
