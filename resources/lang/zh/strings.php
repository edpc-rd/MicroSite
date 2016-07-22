<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'permissions' => [
                'edit_explanation' => '如果你在左邊區域調整了權限組的層次結構，需要刷新當前頁面才能在下面反映最新的層次結構.',

                'groups' => [
                    'hierarchy_saved' => '層次結構已成功保存.',
                ],

                'sort_explanation' => '這個區域可以讓你通過拖拉的方式組織權限組的層次結構. 權限就算不歸入某個分組仍可以獨立分配給每個角色.',
            ],

            'users' => [
                'delete_user_confirm' => '您是否確認要永久刪除這個用戶? 系統中任何使用了該用戶ID的地方可能會引起錯誤. 您需要自行承擔風險. 該操作將不能回退.',
                'if_confirmed_off' => '(If confirmed is off)',
                'restore_user_confirm' => '是否確認將該用戶恢復到原來的狀態?',
            ],
        ],

        'report' => [
            'groups' => [
                'edit_explanation' => '如果你在左邊區域調整了報表分組的層次結構，需要刷新當前頁面才能在下面反映最新的層次結構.',
                'hierarchy_saved' => '層次結構已成功保存.',
                'sort_explanation' => '這個區域可以讓你通過拖拉的方式組織報表分組的層次結構.',
            ],

            'users' => [
                'delete_user_confirm' => '您是否確認要永久刪除這個用戶? 系統中任何使用了該用戶ID的地方可能會引起錯誤. 您需要自行承擔風險. 該操作將不能回退.',
                'if_confirmed_off' => '(If confirmed is off)',
                'restore_user_confirm' => '是否確認將該用戶恢復到原來的狀態?',
            ],
        ],

        'dashboard' => [
            'title' => '管理控制台',
            'welcome' => '歡迎',
        ],

        'general' => [
            'all_rights_reserved' => '版權所有.',
            'are_you_sure' => '是否確定?',
            'boilerplate_link' => 'Laravel 5 Boilerplate',
            'microsite_link' => '微網站',
            'continue' => '繼續',
            'member_since' => '用戶註冊自',
            'search_placeholder' => '搜索...',

            'see_all' => [
                'messages' => '查看全部消息',
                'notifications' => '查看全部',
                'tasks' => '查看所有任務',
            ],

            'status' => [
                'online' => '在線',
                'offline' => '離線',
            ],

            'you_have' => [
                'messages' => '{0} 沒有消息|{1} 您有 1 個消息|[2,Inf] 您有 :number 個消息',
                'notifications' => '{0} 沒有通知|{1} 您有 1 個消息|[2,Inf] 您有 :number 個消息',
                'tasks' => '{0} 沒有任務|{1} 您有 1 任務|[2,Inf] 您有 :number 任務',
            ],
        ],
    ],

    'emails' => [
        'auth' => [
            'password_reset_subject' => '您的密碼重置鏈接',
            'reset_password' => '點擊這裡重置您的密碼',
        ],
    ],

    'frontend' => [
        'email' => [
            'confirm_account' => '點擊這裡確認您註冊的賬號:',
        ],

        'test' => '測試',

        'tests' => [
            'based_on' => [
                'permission' => '基於權限 - ',
                'role' => '基於角色 - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because' => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'user' => [
            'profile_updated' => '資料更新成功.',
            'password_updated' => '密碼修改成功.',
        ],

        'welcome_to' => '歡迎來到 :place',
    ],
];