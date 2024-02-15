<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSubCategories;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    private $subcategories, $category;

    public function __construct(SubCategory $subcategories, Category $category)
    {
        $this->subcategories = $subcategories;
        $this->category = $category;
    }

    public function index($categoryId) {

        $category = $this->category->findOrFail($categoryId);
        $subcategories = $this->subcategories->where('category_id', $category->id)->latest()->paginate();

        return view('admin.pages.categories.subcategories.index', compact('subcategories', 'category'));
    }

    public function create($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('admin.pages.categories.subcategories.create', compact('category'));
    }


    public function store(StoreUpdateSubCategories $request)
    {
        $data = $request->all();

        $data['url'] = Str::kebab($data['name']);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store('categories');
        }

        $subcategory = $this->subcategories::create($data);

        $category = $this->category::findOrFail($data['category_id']);
        $category->subcategories()->attach($subcategory->id);

        return redirect()->route('categories.subcategories.index', $data['category_id'])
                         ->with('success', 'Subcategoria criada com sucesso.');
    }

    public function show($id)
    {
        // Encontre a subcategoria com o ID fornecido
        $subcategory = $this->subcategories->find($id);

        // Verifique se a subcategoria foi encontrada
        if (!$subcategory) {
            return redirect()->back()->with('error', 'Subcategoria não encontrada.');
        }

        // Se a subcategoria foi encontrada, retorne a view com os dados da subcategoria
        return view('admin.pages.categories.subcategories.show', compact('subcategory'));
    }

    public function edit($id)
    {
        $subcategory = $this->subcategories->findOrFail($id);
        return view('admin.pages.categories.subcategories.edit', compact('subcategory'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = $this->subcategories->findOrFail($id);

        $data = $request->all();
        $data['url'] = Str::kebab($data['name']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Se uma nova imagem for enviada, armazene-a
            $data['image'] = $request->image->store("categories");

            // Se houver uma imagem atual, exclua-a
            if ($subcategory->image) {
                Storage::delete($subcategory->image);
            }
        } else {
            // Se nenhuma nova imagem for enviada, mantenha a imagem atual
            $data['image'] = $request->current_image;
        }

        $subcategory->update($data);

        // Encontre a categoria associada à subcategoria
        $category = $subcategory->categories()->first();

        return redirect()->route('subcategories.index', ['categoryId' => $category->id])
                         ->with('success', 'Subcategoria atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $subCategory = $this->subcategories->findOrFail($id);

        // Detach da tabela pivot
        $subCategory->categories()->detach();

        // Exclui a subcategoria
        $subCategory->delete();

        return redirect()->route('categories.index')->with('success', 'Subcategoria excluída com sucesso.');
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


}
