<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplyResource;
use App\Repositories\ReplySupportRepository;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{

    protected $repository;

    public function __construct(ReplySupportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createReply(StoreReplySupport $request)
    {
        $reply = $this->repository->responseSupport($request->validated());

        return new ReplyResource($reply);
    }
}
