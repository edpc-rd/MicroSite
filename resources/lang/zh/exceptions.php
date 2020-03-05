<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'permissions' => [
                'create_error' => '創建權限時出現問題，請重試.',
                'delete_error' => '刪除權限時出現問題，請重試.',

                'groups' => [
                    'associated_permissions' => '您不能刪除這個群組，因為它有關聯的權限.',
                    'has_children' => '您不能刪除這個群組，因為它下面還有子群組.',
                    'name_taken' => '已經存在該群組',
                ],

                'not_found' => '權限不存在.',
                'system_delete_error' => '您不能刪除系統權限.',
                'update_error' => '更新權限時出現問題，請重試.',
            ],

            'roles' => [
                'already_exists' => '該角色已經存在，請選擇其它名稱.',
                'cant_delete_admin' => '您不能刪除管理員角色.',
                'create_error' => '創建角色時出現問題，請重試.',
                'delete_error' => '刪除角色時出現問題，請重試.',
                'has_users' => '您不能刪除這個角色，因為它有關聯的用戶.',
                'needs_permission' => '您必須為該角色選擇至少一個權限.',
                'not_found' => '角色不存在.',
                'update_error' => '更新角色時出現問題，請重試.',
            ],

            'users' => [
                'cant_deactivate_self' => '您不能啟用自己的賬號.',
                'cant_delete_self' => '您不能刪除自己的賬號.',
                'create_error' => '創建用戶時出現問題，請重試.',
                'delete_error' => '刪除用戶時出現問題，請重試.',
                'email_error' => '已有用戶使用該郵箱.',
                'mark_error' => '更新用戶時出現問題，請重試.',
                'not_found' => '用戶不存在.',
                'restore_error' => '恢復用戶時出現問題，請重試.',
                'role_needed_create' => '您必須選擇至少一個角色. 用戶已創建但尚未啟用.',
                'role_needed' => '您必須選擇至少一個角色.',
                'update_error' => '更新用戶時出現問題，請重試.',
                'update_password_error' => '修改用戶密碼時出現問題，請重試.',
            ],
        ],
        'report' => [
            'report' => [
                'already_exists' => '該報表已存在，請重新選擇其他名稱.',
                'cant_delete_active' => '您不能刪除啟用了的報表.',
                'create_error' => '創建報表時出現問題，請重試.',
                'delete_error' => '刪除報表時出現問題，請重試.',
                'mark' => '修改報表狀態出現問題，請重試.',
                'has_users' => '您不能刪除該報表，因為已有用戶訂閱它.',
                'needs_parameter' => '您必須為報表選擇至少一個參數.',
                'not_found' => '報表不存在.',
                'update_error' => '更新報表時出現問題，請重試.',
            ],
            'subscriptions' => [
                'already_exists' => '报表授权已存在，請重新输入.',
                'cant_delete_active' => '您不能禁用已订阅了的報表.',
                'create_error' => '開通報表訂閱時出現問題，請重試.',
                'delete_error' => '刪除報表訂閱時出現問題，請重試.',
                'mark' => '修改報表訂閱狀態出現問題，請重試.',
                'not_found' => '報表訂閱不存在.',
                'update_error' => '更新報表訂閱時出現問題，請重試.',
            ],
            'groups' => [
                'associated_reports' => '您不能刪除這個群組，因為它有關聯的报表.',
                'has_children' => '您不能刪除這個群組，因為它下面還有子群組.',
                'name_taken' => '已經存在該群組',
            ],
            'parameter' => [
                'create_error' => '創建報表参数時出現問題，請重試.',
                'delete_error' => '刪除報表参数時出現問題，請重試.',
                'update_error' => '更新報表参数時出現問題，請重試.',
                'not_found' => '報表参数不存在.',
            ],
            'snapshot' => [
                'create_error' => '創建報表快照時出現問題，請重試.',
                'delete_error' => '刪除報表快照時出現問題，請重試.',
                'update_error' => '更新報表快照時出現問題，請重試.',
                'not_found' => '報表快照不存在.',
            ],
        ],
        'wxconfig' => [
            'wxconfig' => [
                'already_exists' => '該企業微信已存在，請重新選擇其他名稱.',
                'cant_delete_active' => '您不能刪除啟用了的企業微信.',
                'create_error' => '創建企業微信時出現問題，請重試.',
                'delete_error' => '刪除企業微信時出現問題，請重試.',
                'mark' => '修改企業微信狀態出現問題，請重試.',
                'has_users' => '您不能刪除該企業微信，因為已有用戶訂閱它.',
                'needs_parameter' => '您必須為企業微信選擇至少一個參數.',
                'not_found' => '企業微信不存在.',
                'update_error' => '更新企業微信時出現問題，請重試.',
            ],
            'parameter' => [
                'create_error' => '創建企業微信参数時出現問題，請重試.',
                'delete_error' => '刪除企業微信参数時出現問題，請重試.',
                'update_error' => '更新企業微信参数時出現問題，請重試.',
                'not_found' => '企業微信参数不存在.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => ['delete_error' => '刪除報表時出現問題，請重試.',
                'already_confirmed' => '您的賬號已經確認.',
                'confirm' => '請確認您的賬號!',
                'created_confirm' => '用戶賬號成功創建. 已發送一封確認郵件到您的郵箱.',
                'mismatch' => '您的驗證碼不匹配.',
                'not_found' => '驗證碼不存在.',
                'resend' => '您的賬號還沒有確認. 請進入您的郵箱並點擊確認鏈接, 或 <a href="' . route('account.confirm.resend', ':token') . '">點擊這裡</a> 重新發送確認郵件.',
                'success' => '您的賬號已經成功確認!',
                'resent' => '新的確認郵件已經重新發送到您的郵箱.',
            ],

            'deactivated' => '您的賬號已經被停用.',
            'email_taken' => '該郵件地址已經被使用.',

            'password' => [
                'change_mismatch' => '舊密碼輸入錯誤.',
            ],


        ],
    ],
];