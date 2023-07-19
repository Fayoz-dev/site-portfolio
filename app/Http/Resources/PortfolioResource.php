<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'category'=>$this->category->name,
            'client'=>$this->client,
            'image'=>$this->name,
            'video'=>$this->name,
            'published_date'=>$this->published_date,
            'description'=>$this->description,
            'images' => $this->images
        ];
    }
}
