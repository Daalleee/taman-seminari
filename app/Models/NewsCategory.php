<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug'])]
class NewsCategory extends Model
{
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
