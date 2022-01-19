<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'resposta' => $this->description,
            'duvida' => new SupportResource($this->support),
            'professor' => new UserResource($this->user),
            // 'replies' => LessonResource::collection($this->replies),
        ];
    }
}
