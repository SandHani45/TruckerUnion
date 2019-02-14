<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DropPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'id' => $this->id,
                'name' => $this->name,
                'phone_number' => $this->phone_number,
                'image' => $this->image,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'pincode' => $this->pincode,
                'crane' => $this->crane,
                'rampe' => $this->rampe,
                'longitude'=>$this->longitude,
                'latitude'=>$this->latitude,
                'special_requirement' => $this->special_requirement,
                'status' => $this->status,
                'isfavorite' => $this->favorite->sum('status'),
                'timing' =>$this->timings
                 
        ];
    }
}
