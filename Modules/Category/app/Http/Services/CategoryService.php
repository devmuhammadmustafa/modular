<?php

namespace Modules\Category\app\Http\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Base\app\Services\FileUploadService;
use Modules\Category\app\Http\Requests\CategoryRequest;
use Modules\Category\app\Models\Category;

class CategoryService
{
    const CACHETAG = 'categories';

    public function __construct(private FileUploadService $fileUploadService)
    {
    }

    public function create(CategoryRequest $request)
    {
        $data = $request->validated();
        if (request()->hasFile('image')) {
            $data['image'] = $this->fileUploadService->uploadFile(\request('image'), 'categories');
        }
        Category::create($data);
        $this->removeCache();
    }

    public function update(CategoryRequest $request, Category $model)
    {
        $data = $request->validated();
        if (request()->hasFile('image')) {
            $data['image'] = $this->fileUploadService->replaceFile(\request('image'), $model->image, 'categories');
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
