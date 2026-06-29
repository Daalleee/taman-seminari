<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['site_name', 'logo', 'favicon', 'footer', 'copyright'])]
class Setting extends Model
{
    //
}
