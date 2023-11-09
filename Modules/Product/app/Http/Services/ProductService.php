<?php

namespace Modules\Product\app\Http\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Base\app\Services\FileUploadService;
use Modules\Product\app\Http\Requests\ProductRequest;
use Modules\Product\app\Models\Gallery;
use Modules\Product\app\Models\Product;

class ProductService
{
    const CACHETAG = 'products';
    const UPLOADPATH = 'products';

    public function __construct(private FileUploadService $fileUploadService)
    {
    }

    public function create(ProductRequest $request)
    {
        $data = $request->validated();
        if (request()->hasFile('image')) {
            $data['image'] = $this->fileUploadService->uploadFile(\request('image'), self::UPLOADPATH);
        }
        $images = $request['images'] ?? [];
        unset($data['images']);
        $product = Product::create($data);
        $gallery = [];
        if (count($images)>0){
            foreach ($images as $image) {
                $gallery[] = [
                    'image' => $this->fileUploadService->uploadFile($image),
                    'product_id' => $product->id
                ];
            }
        }
        Gallery::query()->insertOrIgnore($gallery);


        $this->removeCache();
    }

    public function update(ProductRequest $request, Product $model)
    {
        $data = $request->validated();
        if (request()->hasFile('image')) {
            $data['image'] = $this->fileUploadService->replaceFile(\request('image'), $model->image, self::UPLOADPATH);
        }
        unset($data['images']);
        $images = $request['images'] ?? [];

        if (count($images) > 0) {

            $gallery = [];
            foreach ($images as $image) {
                $gallery[] = [
                    'image' => $this->fileUploadService->uploadFile($image),
                    'product_id' => $model->id
                ];
            }
            Gallery::query()->insertOrIgnore($gallery);
        }
        $model->update($data);



        $this->removeCache();
    }

    public function remove($model)
    {
        if (!$model->delete()) {
            throw new Exception(trans('Siline bilmez'));
        }
        $this->removeCache();
    }


    public function removeCache()
    {
        Cache::forget(self::CACHETAG);
    }
}
