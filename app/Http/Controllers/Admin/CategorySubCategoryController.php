<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategorySubCategoryController extends Controller
{
    private $category, $subCategory;
    public function __construct(Category $category, SubCategory $subCategory)
    {
        $this->category = $category;

        $this->subCategory = $subCategory;
    }

    public function subcategories($id)
    {

        $category = $this->category->findOrFail($id);
        $subcategories = $this->subCategory->where('category_id', $id)->paginate(10);
        return view('admin.pages.categories.subcategories.index', compact('category', 'subcategories'));
    }

}
