<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'aula' => $this->id,
            'titulo' => ucfirst($this->name),
            'sobre' => $this->description,
            'flag' => $this->url,
            'video' => $this->video,
            'views' => ViewResource::collection($this->whenLoaded('views')),
        ];
    }
}
