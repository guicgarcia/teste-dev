<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;

class BookResource extends JsonResource
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
            'id' => (integer) $this->id,
            'name' => (string) $this->name,
            'author' => (string) $this->author,
            'category' => Category::findOrFail($this->category_id),
            'code' => (string) $this->code,
            'type' => (string) $this->type,
            'size' => (float) $this->size,
        ];
    }
}
