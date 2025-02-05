<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membru extends Model
{
    use HasFactory;

    protected $table = 'membri';
    protected $guarded = [];

    public function path($action = 'show')
    {
        return match ($action) {
            'edit' => route('membri.edit', $this->id),
            'destroy' => route('membri.destroy', $this->id),
            default => route('membri.show', $this->id),
        };
    }

    public function proiecte()
    {
        return $this->belongsToMany(Proiect::class, 'membru_proiect');
    }

}
