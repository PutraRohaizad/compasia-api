<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "product_id" => $this->product_id,
            "type" => $this->type,
            "brand" => $this->brand,
            "model" => $this->model,
            "capacity" => $this->capacity,
            "quantity" => $this->quantity
        ];
    }
}
