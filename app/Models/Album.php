<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'cover'])]
class Album extends Model
{
    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class, 'album_id');
    }
}
