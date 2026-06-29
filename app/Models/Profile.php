<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'history', 'description', 'goal', 'motto', 'logo', 'cover'])]
class Profile extends Model
{
    //
}
