<?php

namespace Modules\Category\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

use Modules\Category\app\Http\Requests\CategoryRequest;
use Modules\Category\app\Http\Services\CategoryService;
use Modules\Category\app\Models\Category;

class CategoryController extends Controller
{
    const viewName = 'category';

    /**
     * Display a listing of the resource.
     */
    public function __construct(private CategoryService $modelService)
    {
    }

    public function index()
    {
        $categories = Category::orderByDesc('id')->get();
        return view(self::viewName.'::index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::viewName.'::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        try {
            $this->modelService->create($request);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Category successfully added']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show(Category $category)
    {
        return view(self::viewName.'::show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view(self::viewName.'::edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        try {
            $this->modelService->update($request, $category);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Category successfully changed']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $this->modelService->remove($category);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Category successfully deleted']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
