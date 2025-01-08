<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ItemUnit extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'alias'
    ];


    public function parentUnit(): BelongsTo
    {
        return $this->belongsTo(ItemUnit::class, 'item_unit_id', 'id');
    }


    protected $keyType = 'string';
    public $incrementing = false;


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
