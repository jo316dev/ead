<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }


    public function getSupports(array $filters = [])
    {
        return $this->getUserAuth()
            ->supports()
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['description'])) {
                    $query->where('description', 'LIKE', "%{$filters['description']}%");
                }
            })->get();
    }

    public function createNewSupport(array $data): Support
    {

        return $this->getUserAuth()
            ->supports()
            ->create([
                'lesson_id' => $data['lesson_id'],
                'description' => $data['description'],
                'status' => $data['status']
            ]);
    }

    public function responseSupport(string $idSupport, array $data)
    {


        return ($this->getSupport($idSupport)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $this->getUserAuth()
            ]));
    }

    private function getUserAuth(): User
    {
        // return auth()->user

        return User::first();
    }

    private function getSupport(string $idSupport)
    {
        return ($this->entity->findOrFail($idSupport));
    }
}
