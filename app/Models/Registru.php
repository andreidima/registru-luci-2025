<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registru extends Model
{
    use HasFactory;

    protected $table = 'registru';
    protected $guarded = [];

    public $timestamps = false;

    public function path()
    {
        return "/registru/{$this->id}";
    }
}
