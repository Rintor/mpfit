<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
