<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug'])]
class ActivityCategory extends Model
{
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'category_id');
    }
}
