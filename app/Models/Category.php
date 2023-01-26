<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pins() {
        return $this->belongsToMany(Pin::class, 'category_pin');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function subcategories() {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public static function getParents() {
        return Category::where('parent_category_id', null)->get();
    }

}
