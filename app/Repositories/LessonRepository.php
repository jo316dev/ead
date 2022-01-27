<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Traits\GetUserLogged;

class LessonRepository
{
    use GetUserLogged;
    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    public function getAllLessonsByModule($id)
    {
        return $this->entity->with('supports.replies')->where('module_id', $id)->get();
    }

    public function getLesson($id)
    {
        return $this->entity->findOrFail($id);
    }

    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUser();

        $viewed = $user->views()->where('lesson_id', $lessonId)->first();

        if ($viewed) {
            return $viewed->update([
                'views' => $viewed->views + 1
            ]);
        }

        return $this->getUser()->views()->create([
            'lesson_id' => $lessonId
        ]);

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }
}
