<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Nette\Utils\DateTime;

class LogsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'transaction' => $this->transaction,
            'number' => $this->number,
            'status' => $this->status,
            'created_at' =>
                (new DateTime($this->created_at))->format('Y-m-d H:i')

        ];
    }
}
