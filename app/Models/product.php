<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'old_price', 'new_price', 'description'];

    public function images()
{
    return $this->hasMany(ProductImage::class);
}
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
