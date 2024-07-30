<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'beds' => $this->beds,
            'baths' => $this->baths,
            'city' => $this->city,
            'code' => $this->code,
            'street' => $this->street,
            'street_nr' => $this->street_nr,
            'price' => $this->price,
            'by_user_id' => $this->owner(),
        ];
    }
}
