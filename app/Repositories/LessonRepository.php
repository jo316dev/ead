<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    public function getAllLessonsByModule($id)
    {
        return $this->entity->where('id', $id)->get();
    }

    public function getLesson($id)
    {
        return $this->entity->findOrFail($id);
    }
}
