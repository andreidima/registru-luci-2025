<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageLog extends Model
{
    use HasFactory;

    // (table name is already the plural of the class, so no need to override)

    /**
     * Mass-assignable attributes.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'file_hash',
        'unique_key',
        'status',
        'rows_imported',
        'rows_skipped',
        'counts_by_b',
    ];

    /**
     * Cast JSON to array automatically.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'rows_imported' => 'integer',
        'rows_skipped'  => 'integer',
        'counts_by_b'   => 'array',
    ];

    /**
     * A UsageLog belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
