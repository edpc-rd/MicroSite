<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => '全部',
        'yes' => '是',
        'no' => '否',
        'custom' => '自定義',
        'actions' => '操作',
        'buttons' => [
            'save' => '保存',
            'update' => '更新',
        ],
        'hide' => '隱藏',
        'none' => 'None',
        'show' => '顯示',
        'toggle_navigation' => '切換導航',
    ],

    'backend' => [
        'access' => [
            'permissions' => [
                'create' => '新建權限',
                'dependencies' => '依賴',
                'edit' => '編輯權限',

                'groups' => [
                    'create' => '新建權限組',
                    'edit' => '編輯權限組',

                    'table' => [
                        'name' => '名稱',
                    ],
                ],

                'grouped_permissions' => '已分組權限',
                'label' => '權限',
                'management' => '權限管理',
                'no_groups' => '沒有權限組.',
                'no_permissions' => '沒有選擇權限.',
                'no_roles' => '沒有設置角色',
                'no_ungrouped' => '沒有尚未分組的權限.',

                'table' => [
                    'dependencies' => '依賴',
                    'group' => '權限組',
                    'group-sort' => '排序',
                    'name' => '名稱',
                    'permission' => '權限',
                    'roles' => '角色',
                    'system' => '系統',
                    'total' => '權限總數',
                    'users' => '用戶',
                ],

                'tabs' => [
                    'general' => '通用',
                    'groups' => '全部分組',
                    'dependencies' => '依賴',
                    'permissions' => '全部權限',
                ],

                'ungrouped_permissions' => '未分組權限',
            ],

            'roles' => [
                'create' => '新建角色',
                'edit' => '編輯角色',
                'management' => '角色管理',

                'table' => [
                    'number_of_users' => '用戶數',
                    'permissions' => '權限',
                    'role' => '角色',
                    'sort' => '排序',
                    'total' => '角色總數',
                ],
            ],

            'users' => [
                'active' => '啟用的用戶',
                'all_permissions' => '全部權限',
                'change_password' => '修改密碼',
                'change_password_for' => 'Change Password for :user',
                'create' => '新建用戶',
                'deactivated' => '停用的用戶',
                'deleted' => '刪除的用戶',
                'dependencies' => '依賴',
                'edit' => '編輯用戶',
                'management' => '用戶管理',
                'no_other_permissions' => '沒有其它的權限',
                'no_permissions' => '沒有權限',
                'no_roles' => '沒有設置角色.',
                'permissions' => '權限',
                'permission_check' => '檢查權限也將檢查它的依賴關係.',
                'subscription' => '訂閱報表',

                'table' => [
                    'confirmed' => '已確認',
                    'created' => '創建時間',
                    'email' => '郵箱',
                    'id' => 'ID',
                    'last_updated' => '最後更新',
                    'name' => '登錄賬號',
                    'nick' => '昵稱',
                    'weixin_id' => '微信號',
                    'remark' => '備註',
                    'last_login' => '最後登錄',
                    'no_deactivated' => '沒有停用的用戶',
                    'no_deleted' => '沒有刪除的用戶',
                    'other_permissions' => '其它權限',
                    'roles' => '角色',
                    'total' => '用戶總數',
                ],

                'subscriptions' =>[
                    'table' => [
                        'report_id' => 'ID',
                        'group' => '報表分組',
                        'name' => '名稱',
                        'report_no' => '編號',
                        'format' => '輸出格式',
                        'allow_subscribe' => '開通',
                        'subscribe_status' => '訂閱',
                        'subscribe_time' => '訂閱時間',
                        'total' => '報表合計',
                    ],
                ]
            ],
        ],
        'report' => [
            'reports' => [
                'create' => '新建報表',
                'edit' => '編輯報表',

                'grouped_permissions' => '已分組權限',
                'label' => '報表',
                'management' => '報表管理',
                'no_groups' => '沒有權限組.',
                'no_permissions' => '沒有選擇權限.',
                'no_roles' => '沒有設置角色',
                'no_ungrouped' => '沒有尚未分組的權限.',

                'table' => [
                    'report_id' => 'ID',
                    'group' => '報表分組',
                    'name' => '名稱',
                    'report_no' => '編號',
                    'format' => '輸出格式',
                    'schedule' => '執行計畫',
                    'allow_subscribe' => '訂閱',
                    'allow_query' => '實時查詢',
                    'receive_mode' => '接收途徑',
                    'status' => '啟用',
                    'query_url' => '查詢路徑',
                    'description' => '描述',
                    'created' => '新增時間',
                    'updated' => '更新時間',
                    'total' => '報表合計',
                ],

                'tabs' => [
                    'general' => '通用',
                    'groups' => '全部分組',
                    'dependencies' => '依賴',
                    'permissions' => '全部權限',
                ],

                'ungrouped_permissions' => '未分組權限',
            ],
            'groups' => [
                'create' => '新建報表分組',
                'edit' => '編輯報表分組',
                'management' => '報表分組管理',

                'table' => [
                    'name' => '名稱',
                ],
            ],

            'roles' => [
                'create' => '新建角色',
                'edit' => '編輯角色',
                'management' => '角色管理',

                'table' => [
                    'number_of_users' => '用戶數',
                    'permissions' => '權限',
                    'role' => '角色',
                    'sort' => '排序',
                    'total' => '角色總數',
                ],
            ],

            'users' => [
                'active' => '啟用的用戶',
                'all_permissions' => '全部權限',
                'change_password' => '修改密碼',
                'change_password_for' => 'Change Password for :user',
                'create' => '新建用戶',
                'deactivated' => '停用的用戶',
                'deleted' => '刪除的用戶',
                'dependencies' => '依賴',
                'edit' => '編輯用戶',
                'management' => '用戶管理',
                'no_other_permissions' => '沒有其它的權限',
                'no_permissions' => '沒有權限',
                'no_roles' => '沒有設置角色.',
                'permissions' => '權限',
                'permission_check' => '檢查權限也將檢查它的依賴關係.',

                'table' => [
                    'confirmed' => '已確認',
                    'created' => '創建時間',
                    'email' => '郵箱',
                    'id' => 'ID',
                    'last_updated' => '最後更新',
                    'name' => '登錄賬號',
                    'nick' => '昵稱',
                    'weixin_id' => '微信號',
                    'remark' => '備註',
                    'last_login' => '最後登錄',
                    'no_deactivated' => '沒有停用的用戶',
                    'no_deleted' => '沒有刪除的用戶',
                    'other_permissions' => '其它權限',
                    'roles' => '角色',
                    'total' => '用戶總數',
                ],
            ],
        ],
        'wxconfig' => [
            'wxconfigs' => [
                'create' => '新建配置',
                'edit' => '編輯配置',
                'upload' => '上傳校驗文件',
                'label' => '企業微信配置',
                'management' => '企業微信管理',
                'no_permissions' => '沒有選擇權限.',

                'table' => [
                    'id' => 'ID',
                    'name' => '企業微信名稱   ',
                    'appid' => 'APPID',
                    'appsecret' => 'APPSECRET',
                    'agentid' => '應用ID',
                    'token' => 'Token',
                    'aeskey' => 'AESKEY',
                    'created' => '新增時間',
                    'updated' => '更新時間',
                    'total' => '企業微信合計',
                ],
                'tabs' => [
                    'general' => '通用',
                    'dependencies' => '依賴',
                    'permissions' => '全部權限',
                ],
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title' => '用戶登錄',
            'login_button' => '登錄',
            'login_with' => '使用第三方登錄',
            'register_box_title' => '用戶註冊',
            'register_button' => '註冊',
            'remember_me' => '記住賬號',
        ],

        'passwords' => [
            'forgot_password' => '忘記密碼?',
            'reset_password_box_title' => '重置密碼',
            'reset_password_button' => '重置密碼',
            'send_password_reset_link_button' => '發送重置密碼鏈接',
        ],

        'macros' => [
            'country' => [
                'alpha' => 'Country Alpha Codes',
                'alpha2' => 'Country Alpha 2 Codes',
                'alpha3' => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us' => [
                    'us' => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed' => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => '修改密碼',
            ],

            'profile' => [
                'avatar' => '頭像',
                'created_at' => '註冊時間',
                'edit_information' => '修改',
                'email' => '郵箱',
                'last_updated' => '最後修改時間',
                'name' => '登錄賬號',
                'nick' => '昵稱',
                'weixin_id' => '微信號',
                'update_information' => '修改信息',
            ],
        ],

    ],
];
