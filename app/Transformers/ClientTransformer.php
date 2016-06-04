<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 28/01/2016
 * Time: 19:53
 */

namespace JrMessias\Transformers;

use JrMessias\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends  TransformerAbstract
{

    /**
     * @param Client $client
     * @return array
     */
    public function transform(Client $client){
        return [
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs
        ];
    }
}