<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'identify' => $this->identify,
            'total' => number_format($this->total,2, ',', '.'),
            'clients' => $this->client_id ? new ClientResource($this->client) : 'Client not informed',
            'tables' => $this->table_id ? new TableResource($this->table) : 'Table not informed',
            'products' => ProductResource::collection($this->products),
            'status' => $this->status,
        ];
    }
}
