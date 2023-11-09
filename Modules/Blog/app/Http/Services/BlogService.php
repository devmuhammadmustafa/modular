<?php

namespace Modules\Blog\app\Http\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Base\app\Services\FileUploadService;
use Modules\Blog\App\Http\Requests\BlogRequest;
use Modules\Blog\app\Models\Blog;

class BlogService
{
    const CACHETAG = 'blogs';
    const UPLOADPATH = 'blogs';

    public function __construct(private FileUploadService $fileUploadService)
    {
    }

    public function create(BlogRequest $request)
    {
        $data = $request->validated();
        if (request()->hasFile('image')) {
            $data['image'] = $this->fileUploadService->uploadFile(\request('image'), self::UPLOADPATH);
        }

        Blog::create($data);
        $this->removeCache();
    }

    public function update(BlogRequest $request, Blog $model)
    {
        $data = $request->validated();
        if (request()->hasFile('image')) {
            $data['image'] = $this->fileUploadService->replaceFile(\request('image'), $model->image, self::UPLOADPATH);
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
