<?php

namespace Modules\Product\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Cache;
use Modules\Product\app\Models\Product;
use Modules\Product\app\Http\Requests\ProductRequest;
use Modules\Product\app\Http\Services\ProductService;

class ProductController extends Controller
{
    const viewName = 'product';

    /**
     * Display a listing of the resource.
     */
    public function __construct(private ProductService $modelService)
    {
    }

    public function index()
    {
        $items = Product::orderByDesc('id')->get();
        return view(self::viewName . '::index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Cache::rememberForever(ProductService::CACHETAG, function () {
            return Product::all();
        });
        return view(self::viewName . '::create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            $this->modelService->create($request);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Product successfully added']);
        } catch (\Exception $e) {
            dd($e->getMessage());

            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::viewName . '::show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Cache::rememberForever(ProductService::CACHETAG, function () {
            return Product::all();
        });
        $images=$product->load('images')->images;
        return view(self::viewName . '::edit', compact('product','categories','images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        try {
            $this->modelService->update($request, $product);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Product successfully changed']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->modelService->remove($product);
            return redirect()->back()->with(['type' => 'success', 'message' => 'Product successfully deleted']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
