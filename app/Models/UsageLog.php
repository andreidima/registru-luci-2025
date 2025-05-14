<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageLog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * (Only needed if you ever change the name;
     * by default it'll use 'usage_logs'.)
     *
     * @var string
     */
    // protected $table = 'usage_logs';

    /**
     * The attributes that are mass assignable.
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'rows_imported' => 'integer',
        'rows_skipped'  => 'integer',
    ];

    /**
     * A UsageLog belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
