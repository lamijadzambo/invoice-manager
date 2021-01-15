<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static $atemshutz = 1;

    public static $flipflop = 2;

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
