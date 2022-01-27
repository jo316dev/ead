<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;
use App\Repositories\Traits\GetUserLogged;

class SupportRepository
{
    use GetUserLogged;

    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function getMySupports(array $filters = [])
    {
        $filters['user'] = true;

        return $this->getSupports($filters);
    }


    public function getSupports(array $filters = [])
    {
        return $this->entity
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

                if (isset($filters['user'])) {
                    $user = $this->getUser();

                    $query->where('user_id', $user->id);
                }
            })->with('replies')->orderBy('updated_at')->get();
    }

    public function createNewSupport(array $data): Support
    {

        return $this->getUser()
            ->supports()
            ->create([
                'lesson_id' => $data['lesson_id'],
                'description' => $data['description'],
                'status' => $data['status']
            ]);
    }

    public function responseSupport($idSupport, array $data)
    {
        $user = $this->getUser();

        return $this->getSupport($idSupport)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id
            ]);
    }


    private function getSupport($idSupport)
    {
        return $this->entity->findOrFail($idSupport);
    }
}
