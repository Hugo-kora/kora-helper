<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategories;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    private $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->categories->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->categories::all();

        return view('admin.pages.categories.create',compact('categories'));
    }

    public function store(StoreUpdateCategories $request)
    {
            $data = $request->all();

            $data['url'] = Str::kebab($data['name']);

            if ($request->hasFile('image') && $request->image->isValid()) {
                $data['image'] = $request->image->store('categories');
            }

            $this->categories->create($data);

            return redirect()->route('categories.index')
                             ->with('success', 'Contato adicionado com sucesso.');
    }

    public function show($id)
    {
        if (!$category = $this->categories->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categories->findOrFail($id);
        return view('admin.pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = $this->categories->findOrFail($id);

        $data = $request->all();
        $data['url'] = Str::kebab($data['name']);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("categories");
        }

        $category->update($data);

        return redirect()->route('categories.index')
                         ->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy($id)
    {
        // Encontre a categoria com o ID fornecido
        $category = Category::findOrFail($id);

        // Exclua as subcategorias associadas
        $category->subcategories()->delete();

        // Exclua a categoria
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Categoria e suas subcategorias foram excluídas com sucesso.');
    }

    // public function search(Request $request)
    // {
    //     $filters = $request->all();

    //     $facs = $this->facs->latest()->paginate();

    //     $contacts = $this->repository
    //                         ->where(function($query) use ($request) {
    //                             if ($request->filter) {
    //                                 $query->orWhere('name', 'LIKE', "%{$request->filter}%");
    //                                 $query->orWhere('surname', $request->filter);
    //                             }
    //                         })
    //                         ->latest()
    //                         ->paginate();

    //     return view('admin.pages.contacts.index', compact('contacts', 'filters','facs'));
    // }

    // public function searchFacs(Request $request)
    // {
    //     $filters = $request->all();
}
