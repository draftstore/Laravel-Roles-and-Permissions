<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'table_name', 'changed_columns', 'action'];

    protected $casts = [
        'changed_columns' => 'array', // Automatically decode JSON data
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
