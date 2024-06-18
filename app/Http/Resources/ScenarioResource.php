<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScenarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $format = 'd-m-Y';

        return [
            'id' => $this->id,
            'name' => $this->name,
            'system' => $this->system,
        ];
    }
}
