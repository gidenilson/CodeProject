<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    public function transform (Client $client){
        return [
            "id"=>$client->id,
            "name"=>$client->id,
            "responsible"=>$client->responsible,
            "email"=>$client->email,
            "phone"=>$client->phone,
            "address"=>$client->address,
            "obs"=>$client->obs,
            "created_date"=>$client->created_date,
            "updated_date"=>$client->updated_date
        ];
    }
}








