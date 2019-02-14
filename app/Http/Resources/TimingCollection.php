<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TimingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'Sample message',
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time
        ];
    }
}
