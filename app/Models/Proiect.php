<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proiect extends Model
{
    use HasFactory;

    protected $table = 'proiecte';
    protected $guarded = [];

    protected $casts = [
        'data_contract' => 'datetime',
        'data_proces_verbal_predare_primire' => 'datetime',
    ];

    public function path($action = 'show')
    {
        return match ($action) {
            'edit' => route('proiecte.edit', $this->id),
            'destroy' => route('proiecte.destroy', $this->id),
            default => route('proiecte.show', $this->id),
        };
    }

    public function membri()
    {
        return $this->belongsToMany(Membru::class, 'membru_proiect');
    }

    public function subcontractanti()
    {
        return $this->belongsToMany(Subcontractant::class, 'proiect_subcontractant');
    }

    public function fisiere()
    {
        return $this->morphMany(Fisier::class, 'owner');
    }
}
