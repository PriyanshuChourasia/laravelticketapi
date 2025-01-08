<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'cost',
        'user_id',
        'qtn',
        'item_unit_id',
        'item_group_id'
    ];

    public function item_unit(): BelongsTo
    {
        return $this->belongsTo(ItemUnit::class, 'item_unit_id', 'id');
    }

    public function item_group(): BelongsTo
    {
        return $this->belongsTo(ItemGroup::class, 'item_group_id', 'id');
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
