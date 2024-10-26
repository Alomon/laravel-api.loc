<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'book' => [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'photo' => $this->photo,
            ],
            'author' => [
                'id' => $this->author->id,
                'name' => $this->author->fullname,
            ]

        ];
    }
}
