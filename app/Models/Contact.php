<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['address', 'phone', 'email', 'maps', 'facebook', 'instagram', 'youtube'])]
class Contact extends Model
{
    //
}
