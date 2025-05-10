<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Table;

class TableReserveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Table' => new TableResource(Table::find($this->table_id)),
            'date' => $this->date,
            'the_time' => $this->the_time,
            'numbers_people' => $this->number_people,
        ];
    }
}
