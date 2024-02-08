<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'subcategories';

    protected $fillable = ['name','url','anchor_url','image','color_card','color_icon','category_id','created_at','updated_at','created_by','updated_by','deleted_by','created_by_email','updated_by_email','deleted_by_email'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_subcategory', 'subcategory_id', 'category_id');
    }
}
