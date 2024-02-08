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

        $count = count($categories);

        // Adiciona os dois arrays iniciais, se houver pelo menos um item na coleção
        if ($count >= 1) {
            $finalCategories[] = $categories[0]->toArray();
        }
        if ($count >= 2) {
            $finalCategories[] = $categories[1]->toArray();
        }

        // Adiciona os dois null sequenciais apenas se houver pelo menos três itens na coleção
        if ($count >= 3) {
            $finalCategories[] = null;
            $finalCategories[] = null;
        }

        // Adiciona os próximos três arrays se houver mais de cinco itens na coleção
        for ($i = 2; $i < min(5, $count); $i++) {
            $finalCategories[] = $categories[$i]->toArray();
        }

        // Adiciona apenas um null se houver mais de cinco itens na coleção
        if ($count > 5) {
            $finalCategories[] = null;
        }

        // Adiciona o próximo array se houver mais de cinco itens na coleção
        if ($count > 5) {
            $finalCategories[] = $categories[5]->toArray();
        }

        // Repete a mesma estrutura para os elementos restantes
        for ($i = 6; $i < $count; $i++) {
            // Adiciona os próximos três arrays
            $finalCategories[] = $categories[$i]->toArray();
            $finalCategories[] = $categories[$i + 1]->toArray();
            $finalCategories[] = $categories[$i + 2]->toArray();

            // Adiciona apenas um null
            $finalCategories[] = null;

            // Atualiza o índice $i para pular os próximos dois arrays já adicionados
            $i += 2;
        }

        return view('welcome', compact('finalCategories'));
    }



}
