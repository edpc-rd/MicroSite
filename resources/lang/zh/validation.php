<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => '提交 :attribute 必須是認可的.',
    'active_url' => '提交 :attribute 不是合法的 URL.',
    'after' => '提交 :attribute 日期只能在此日期之後 :date.',
    'alpha' => '提交 :attribute 只允許包含字母.',
    'alpha_dash' => '提交 :attribute 只允許包含字母、破折號和數字.',
    'alpha_num' => '提交 :attribute 只允許包含字母和數字.',
    'array' => '提交 :attribute must 必須是數組類型.',
    'before' => '提交 :attribute 日期只能在此日期之前 :date.',
    'between' => [
        'numeric' => '提交 :attribute 數值必須在 :min 和 :max 之間.',
        'file' => '提交 :attribute 文件大小必須在 :min 和 :max 字節之間.',
        'string' => '提交 :attribute 內容長度必須在 :min and :max 字符之間.',
        'array' => '提交 :attribute 數組長度必須在 :min and :max 之間.',
    ],
    'boolean' => '提交 :attribute 必須是 true 或 false.',
    'confirmed' => '提交 :attribute 必須有與之匹配的字段.',
    'date' => '提交 :attribute 不是個合法的日期.',
    'date_format' => '提交 :attribute 日期格式不正確 :format.',
    'different' => '提交 :attribute 和 :other 不能相同.',
    'digits' => '提交 :attribute 必須是數值且長度為 :digits .',
    'digits_between' => '提交 :attribute 數值長度必須介於 :min 和 :max 之間.',
    'email' => '提交 :attribute 必須是個合法的Email地址.',
    'exists' => '提交  :attribute 必須存在指定數據表.',
    'filled' => '提交 :attribute 必須存在.',
    'image' => '提交 :attribute 必須為圖片.',
    'in' => '提交 :attribute 內容不在支持範圍內.',
    'integer' => '提交 :attribute 必須為整數.',
    'ip' => '提交 :attribute 必須為合法的 IP 地址.',
    'json' => '提交 :attribute 必須為合法的 JSON 字符串.',
    'max' => [
        'numeric' => '提交 :attribute 須小於 :max.',
        'file' => '提交 :attribute 須最多支持 :max 個字節.',
        'string' => '提交 :attribute 須最多支持 :max 個字符.',
        'array' => '提交 :attribute 須最多支持 :max 個項目.',
    ],
    'mimes' => '提交 :attribute 文件類型必須是: :values.',
    'min' => [
        'numeric' => '提交 :attribute 須大於 :min.',
        'file' => '提交 :attribute 須至少含有 :min 個字節.',
        'string' => '提交 :attribute 須至少含有 :min 個字符.',
        'array' => '提交 :attribute 須至少含有 :min 個項目.',
    ],
    'not_in' => '提交 :attribute 內容不在支持範圍內.',
    'numeric' => '提交 :attribute 必須是數字.',
    'regex' => '提交 :attribute 輸入格式不正確.',
    'required' => '提交 :attribute 不能為空.',
    'required_if' => '提交 :attribute 不能為空,當 :other 等於 :value.',
    'required_unless' => '提交 :attribute 不能為空,除了 :other 等於 :values.',
    'required_with' => '提交 :attribute 不能為空，當 :values 存在.',
    'required_with_all' => '提交 :attribute 只有在所有指定字段存在的情况下才是必须的 :values .',
    'required_without' => '提交 :attribute 只有当任一指定字段不存在的情况下才是必须的 :values .',
    'required_without_all' => '提交 :attribute 只有当所有指定字段不存在的情况下才是必须的 :values .',
    'same' => '提交 :attribute 和 :other 必須一致.',
    'size' => [
        'numeric' => '提交 :attribute 數值長度必須等於:size.',
        'file' => '提交 :attribute 文件大小必須等於 :size 個字節.',
        'string' => '提交 :attribute 內容長度必須等於 :size 個字符.',
        'array' => '提交 :attribute 數組必須包含 :size 個項目.',
    ],
    'string' => '提交 :attribute 必須為字符串.',
    'timezone' => '提交 :attribute 必須為時間.',
    'unique' => '提交 :attribute 已經被使用.',
    'url' => '提交 :attribute url格式不正確.',
    'captcha' => '提交 驗證碼不正確,請重新輸入',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => '定制消息',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => '關聯的角色',
                    'dependencies' => '依賴',
                    'display_name' => '顯示名稱',
                    'group' => '權限組',
                    'group_sort' => '權限組排序',

                    'groups' => [
                        'name' => '權限組名稱',
                    ],

                    'name' => '名稱',
                    'system' => '系統權限?',
                ],

                'roles' => [
                    'associated_permissions' => '關聯的權限',
                    'name' => '名稱',
                    'sort' => '排序',
                ],

                'users' => [
                    'active' => '啟用',
                    'associated_roles' => '關聯的角色',
                    'confirmed' => '已確認',
                    'email' => '郵箱地址',
                    'name' => '登錄帳號',
                    'nick' => '昵稱',
                    'weixin_id' => '微信號',
                    'remark' => '備註',
                    'send_wxid' => '發送企業微信',
                    'other_permissions' => '其它權限',
                    'password' => '密碼',
                    'password_confirmation' => '確認密碼',
                    'send_confirmation_email' => '發送確認郵件',
                ],
            ],
            'report' => [
                'reports' => [
                    'group' => '報表分組',
                    'report_no' => '報表編號',
                    'name' => '報表名稱',
                    'format' => '輸出格式',
                    'schedule' => '執行計畫',
                    'status' => '報表狀態',
                    'allow_subscribe' => '是否允許訂閱',
                    'allow_query' => '是否允許實時查詢',
                    'receive_mode' => '接收模式',
                    'query_url' => '查詢路徑',
                    'description' => '描述',
                ],

                'groups' => [
                    'name' => '報表分組名稱',
                    'sort' => '排序',
                ],

                'users' => [
                    'active' => '啟用',
                    'associated_roles' => '關聯的角色',
                    'confirmed' => '已確認',
                    'email' => '郵箱地址',
                    'name' => '登錄帳號',
                    'nick' => '昵稱',
                    'weixin_id' => '微信號',
                    'remark' => '備註',
                    'other_permissions' => '其它權限',
                    'password' => '密碼',
                    'password_confirmation' => '確認密碼',
                    'send_confirmation_email' => '發送確認郵件',
                ],
            ],
            'wxconfig' => [
                'wxconfigs' => [
                    'id' => '企業微信ID',
                    'name' => '企業微信名稱',
                    'appid' => 'APPID',
                    'appsecret' => 'APPSECRET',
                    'agentid' => '應用ID',
                    'status' => '報表狀態',
                    'token' => 'Token',
                    'aeskey' => 'AESKEY',
                    'check' => '對接檢測',
                    'upload' => '校驗文件',
                ],
            ],
        ],

        'frontend' => [
            'email' => '郵箱地址',
            'name' => '登錄帳號',
            'nick' => '昵稱',
            'weixin_id' => '微信號',
            'remark' => '備註',
            'password' => '密碼',
            'captcha' => '驗證碼',
            'password_confirmation' => '確認密碼',
            'old_password' => '舊密碼',
            'new_password' => '新密碼',
            'new_password_confirmation' => '確認密碼',
        ],
    ],

];
