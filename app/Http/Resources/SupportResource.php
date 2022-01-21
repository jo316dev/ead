<?php

namespace App\Http\Resources;

use App\Models\ReplySupport;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
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
            'description' => $this->description,
            'status' => $this->statusOptions[$this->status],
            'aluno' => new UserResource($this->user),
            'lesson_id' => new LessonResource($this->lesson),
            'data_reposta' => Carbon::make($this->updated_at)->format('H:i:s - d/m/Y')
        ];
    }
}
