<?php

namespace App\Domain\Tasks;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //  public $timestamps = false;
    protected $fillable = ['title', 'note', 'is_completed', 'tags'];
}
