<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'event_date', 'location', 'poster'])]
class Event extends Model
{
    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
        ];
    }
}
