<?php

namespace App\Http\Controllers;

use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    protected $repository;

    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($id)
    {
        return ModuleResource::collection($this->repository->getModulesByCourse($id));
    }
}
