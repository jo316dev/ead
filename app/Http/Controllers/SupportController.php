<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupport;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $entity;

    public function __construct(SupportRepository $repository)
    {
        $this->entity = $repository;
    }

    public function index(Request $request)
    {
        return SupportResource::collection($this->entity->getSupports($request->all()));
    }


    public function store(StoreSupport $request)
    {
        return new SupportResource($this->entity->createNewSupport($request->validated()));
    }
}