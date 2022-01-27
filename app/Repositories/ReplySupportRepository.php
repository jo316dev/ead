<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Repositories\Traits\GetUserLogged;

class ReplySupportRepository
{

    use GetUserLogged;

    private $entity;


    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }


    public function responseSupport($data)
    {

        $user = $this->getUser();

        return $this->entity->create([
            'support' => $data['support'],
            'description' => $data['description'],
            'user_id' => $user->id
        ]);
    }

    private function getSupport($id)
    {
        return $this->entity->findOrFail($id);
    }
}
