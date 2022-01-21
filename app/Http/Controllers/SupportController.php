<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupport;
use App\Http\Requests\StoreSupport;
use App\Http\Resources\ReplyResource;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return SupportResource::collection($this->repository->getSupports($request->all()));
    }


    public function store(StoreSupport $request)
    {
        return new SupportResource($this->repository->createNewSupport($request->validated()));
    }

    public function MySupports(Request $request)
    {
        $supports = $this->repository->getSupports($request->all());


        return SupportResource::collection($supports);
    }
}
