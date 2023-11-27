<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;
	

    protected $fillable = [
        'articale', 'name', 'status'
    ];

	protected $casts = [
        'data' => 'array',
    ];

	public function scopeAvailable(Builder $query): void
    {
        $query->where('status', available);
    }


}
