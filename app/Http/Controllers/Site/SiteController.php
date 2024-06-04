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

        if ($categories->isEmpty()) {
            // Se não houver categorias, retorne uma visualização com um array vazio
            return view('welcome', compact('finalCategories'));
        }

        // Inicializar todos os espaços como nulos para garantir que todos os índices estejam definidos
        $finalCategories = array_fill(0, 11, null); // Inicializa 12 posições com null

        // Preencher o array conforme a nova ordem definida
        if (!empty($categories[0])) $finalCategories[0] = $categories[0]->toArray();
        if (!empty($categories[1])) $finalCategories[1] = $categories[1]->toArray();
        $finalCategories[2] = null; // Primeiro nulo
        $finalCategories[3] = null; // Segundo nulo
        $finalCategories[4] = null; // Terceiro nulo adicional
        if (!empty($categories[2])) $finalCategories[5] = $categories[2]->toArray();
        if (!empty($categories[3])) $finalCategories[6] = $categories[3]->toArray();
        $finalCategories[7] = null; // Quarto nulo
        if (!empty($categories[4])) $finalCategories[8] = $categories[4]->toArray();
        $finalCategories[9] = null; // Quinto nulo
        if (!empty($categories[5])) $finalCategories[10] = $categories[5]->toArray();
        if (!empty($categories[6])) $finalCategories[11] = $categories[6]->toArray();

        return view('welcome', compact('finalCategories'));
    }

}

