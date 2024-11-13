<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'text',
        'author',
    ];

    protected static function booted()
    {
        static::updating(function ($post) {
            self::logChanges('updated', $post);
        });

        static::creating(function ($post) {
            self::logChanges('created', $post);
        });

        static::deleting(function ($post) {
            self::logChanges('deleted', $post);
        });
    }

    protected static function logChanges($action, $model)
    {
        if (Auth::check()) {
            $changedColumns = [];
            
            // Track column changes only on update
            if ($action === 'updated') {
                foreach ($model->getDirty() as $column => $newValue) {
                    $changedColumns[$column] = [
                        'old' => $model->getOriginal($column),
                        'new' => $newValue
                    ];
                }
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'table_name' => $model->getTable(''),
                'changed_columns' => $changedColumns,
                'action' => $action
            ]);

        }
    }

}
