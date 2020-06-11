<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

protected $table = 'categories';
protected $primaryKey = 'catid';

public $timestamps = false;

protected $fillable = ['cattitle','cattext','catconfirm'];
}
