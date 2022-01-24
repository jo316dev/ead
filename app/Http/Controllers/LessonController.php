<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreView;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index($id)
    {
        return LessonResource::collection($this->repository->getAllLessonsByModule($id));
    }

    public function show($id)
    {
        return new LessonResource($this->repository->getLesson($id));
    }

    public function viewed(StoreView $request)
    {

        $this->repository->markLessonViewed($request->lesson);

        return response()->json(['success' => true]);
    }
}
