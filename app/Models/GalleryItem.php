<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['album_id', 'image', 'caption'])]
class GalleryItem extends Model
{
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
