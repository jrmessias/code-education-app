<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 28/01/2016
 * Time: 19:53
 */

namespace JrMessias\Transformers;

use League\Fractal\TransformerAbstract;

class ClientTransformer extends  TransformerAbstract
{

    public function transform(User $user){
        return [
            'name' => $user->name,
            'email' => $user->email
        ];
    }
}