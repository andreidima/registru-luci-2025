<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcontractant extends Model
{
    use HasFactory;

    protected $table = 'subcontractanti';
    protected $guarded = [];

    protected $casts = [
        'data_inceput_contract' => 'datetime',
        'data_sfarsit_contract' => 'datetime',
    ];

    public function path($action = 'show')
    {
        return match ($action) {
            'edit' => route('subcontractanti.edit', $this->id),
            'destroy' => route('subcontractanti.destroy', $this->id),
            default => route('subcontractanti.show', $this->id),
        };
    }

    public function proiecte()
    {
        return $this->belongsToMany(Proiect::class, 'proiect_subcontractant');
    }
}
