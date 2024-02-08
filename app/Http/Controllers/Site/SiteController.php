<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    private $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->categories->with(['subcategories'])->get();
        $finalCategories = [];
        $count = count($categories);

        for ($i = 0; $i < $count; $i++) {
            if ($i % 3 == 0) {
                // Adiciona dois arrays e um null
                $finalCategories[] = $categories[$i]->toArray();
                if ($i + 1 < $count) {
                    $finalCategories[] = $categories[$i + 1]->toArray();
                    $i++;
                } else {
                    $finalCategories[] = null;
                }
                $finalCategories[] = null;
            } else {
                // Adiciona um null e um array
                $finalCategories[] = null;
                if ($i < $count) {
                    $finalCategories[] = $categories[$i]->toArray();
                } else {
                    $finalCategories[] = null;
                }
            }
        }

        return view('welcome', compact('finalCategories'));
    }




}
