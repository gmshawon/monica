<?php

namespace App\Http\Resources\Reminder;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Contact\ContactShort as ContactShortResource;

class Reminder extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'object' => 'reminder',
            'title' => $this->title,
            'description' => $this->description,
            'frequency_type' => $this->frequency_type,
            'frequency_number' => $this->frequency_number,
            'last_triggered_date' => DateHelper::getTimestamp($this->last_triggered),
            'next_expected_date' => DateHelper::getTimestamp($this->next_expected_date),
            'account' => [
                'id' => $this->account_id,
            ],
            'contact' => new ContactShortResource($this->contact),
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }
}
