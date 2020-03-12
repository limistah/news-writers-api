<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WritersResource extends JsonResource
{
    public function mapInto($request)
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "bio" => $this->bio,
            "articles_count" => $this->articles_count
        ];
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "bio" => $this->bio,
            "articles_count" => $this->articles_count
        ];
    }
}
