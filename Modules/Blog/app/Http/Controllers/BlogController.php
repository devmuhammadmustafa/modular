<?php

namespace Modules\Blog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Blog\App\Http\Requests\BlogRequest;
use Modules\Blog\app\Models\Blog;
use Modules\Blog\app\Http\Services\BlogService;


class BlogController extends Controller
{
    const viewName = 'blog';

    /**
     * Display a listing of the resource.
     */
    public function __construct(private BlogService $modelService)
    {
    }

    public function index()
    {
        $items = Blog::orderByDesc('id')->get();
        return view(self::viewName.'::index', compact('items'));
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
    public function store(BlogRequest $request): RedirectResponse
    {

        try {
            $this->modelService->create($request);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Blog successfully added']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show(Blog $blog)
    {
        return view(self::viewName.'::show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view(self::viewName.'::edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        try {
            $this->modelService->update($request, $blog);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Blog successfully changed']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        try {
            $this->modelService->remove($blog);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Blog successfully deleted']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
