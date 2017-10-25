<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    //
    protected $table = 'views';
    protected $guarded = ['id'];
}
