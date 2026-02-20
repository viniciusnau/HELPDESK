<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::latest()->get();
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json($category, 201);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        if ($category->tickets()->count() > 0) {
            return response()->json([
                'message' => 'Não é possível deletar categoria com chamados associados.'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'message' => 'Categoria deletada com sucesso.'
        ]);
    }
}
