<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
          'Name'=>$this->name,
            'Description'=>$this->description,
            'Image'=>asset('storage/Product_image/' . $this->image),
            'category'=>Category::where('id',$this->category_id)->value('name'),
            'Price'=>$this->price,
            'Total Calories'=>$this->total_calories,
            'Protien'=>$this->protien,
            'Carb'=>$this->carb,
            'Fat'=>$this->fat,
            'Weight'=>$this->weight,
        ];
    }
}
