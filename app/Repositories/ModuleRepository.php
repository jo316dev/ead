<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    private $entity;

    public function __construct(Module $model)
    {
        $this->entity = $model;
    }


    public function getModulesByCourse($id)
    {
        return $this->entity->with('lessons.views')->where('course_id', $id)->get();
    }
}
