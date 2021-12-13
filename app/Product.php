<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class Product extends Model
{
  protected $fillable = [
    'name', 'image_url', 'category_id', 'description',
    'description', 'price', 'stock', 'review'
  ];

  public function category(){
    return $this->belongsTo(Category::class);
  }
  public function orderItems(){
    return $this->hasMany(OrderItem::class);
  }
}
