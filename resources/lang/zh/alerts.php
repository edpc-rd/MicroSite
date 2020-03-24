<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'permissions' => [
            'created' => '成功創建權限.',
            'deleted' => '成功刪除權限.',

            'groups' => [
                'created' => '成功創建權限組.',
                'deleted' => '成功刪除權限組.',
                'updated' => '成功更新權限組.',
            ],

            'updated' => '成功更新權限組.',
        ],

        'roles' => [
            'created' => '成功創建角色.',
            'deleted' => '成功刪除角色.',
            'updated' => '成功更新角色.',
        ],

        'users' => [
            'confirmation_email' => '新的確認郵件已經發送到您的郵箱.',
            'created' => '成功創建用戶.',
            'deleted' => '成功刪除用戶.',
            'deleted_permanently' => '用戶已被永久刪除.',
            'restored' => '用戶已成功恢復.',
            'updated' => '用戶已成功更新.',
            'updated_password' => "用戶密碼已成功修改.",
        ],
        'subscriptions' => [
            'deactivated' => '關閉報表訂閱成功.',
            'activated' => '開通報表訂閱成功.',
            'updated' => '更新訂閱狀態成功.',
            'created' => '更新訂閱狀態成功.',
        ],
        'reports' => [
            'created' => '成功創建報表.',
            'deleted' => '成功刪除報表.',
            'deleted_permanently' => '報表已被永久刪除.',
            'restored' => '報表已成功恢復.',
            'updated' => '報表已成功更新.',
            'send' => '成功發送報表.',
        ],
        'wxconfigs' => [
            'created' => '成功創建企業微信.',
            'deleted' => '成功刪除企業微信.',
            'deleted_permanently' => '企業微信已被永久刪除.',
            'restored' => '企業微信已成功恢復.',
            'updated' => '企業微信已成功更新.',
            'succ' => '已成功向企業微信發送測試消息！',
            'fail' => '向企業微信發送測試消息失敗！',
        ],
        'groups' => [
            'created' => '成功創建報表分組.',
            'deleted' => '成功刪除報表分組.',
            'deleted_permanently' => '報表分組已被永久刪除.',
            'updated' => '報表分組已成功更新.',
        ],

    ],
];