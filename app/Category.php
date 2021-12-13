<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Category extends Model
{
  protected $fillable = [
    'title'
  ];

  public function product(){
    return $this->hasMany(Product::class);
  }
}
