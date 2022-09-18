<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'number_id',
        'email',
        'country',
        'address',
        'phone',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
