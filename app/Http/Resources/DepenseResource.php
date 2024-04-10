<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'amount' => $this->amount,
            'Description' => $this->Description,
            'date' => $this->date,          
            // 'id' => $this->id,
            // 'user_id' => $this->user_id,
            // 'update at' => $this->update at,
            // 'created at' => $this->created at
        ];
    }
}
