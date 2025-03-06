<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'discount_price', 'quantity', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
