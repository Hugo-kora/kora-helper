<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'categories';

    protected $fillable = ['name','url','anchor_url','image','color_card','color_icon','created_at','updated_at','created_by','updated_by','deleted_by','created_by_email','updated_by_email','deleted_by_email'];

    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class, 'category_subcategory', 'category_id', 'subcategory_id');
    }
}
