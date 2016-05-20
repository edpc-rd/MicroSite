<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Access\User\User;

class UserTransformer extends TransformerAbstract {
    
    public function transform(User $user) {
        return [
            'id' => $user['user_id'],
            'name' => $user['user_name'],
            'email' => $user['email'],
        ];
    }
}


