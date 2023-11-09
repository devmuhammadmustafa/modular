<?php

namespace Modules\Product\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {

        $return = [
            ...$this->getTitles(),
            ...$this->getDesc(),
            'category_id' => ['required'],
            'images' => 'array',
//            'images.*' => [Rule::requiredIf(request()->method() == 'PUT')]
        ];

        if (request()->method() == 'PUT') {
            $return['image'] = ['nullable'];
        } else {
            $return['image'] = ['required', 'image'];
        }

        return $return;
    }


    public function getTitles()
    {
        $title = [];
        foreach (config('lang.langs') as $lang) {
            $title['title_' . $lang] = ['required'];
        }
        return $title;
    }

    public function getDesc()
    {
        $title = [];
        foreach (config('lang.langs') as $lang) {
            $title['description_' . $lang] = ['required'];
        }
        return $title;
    }

    /**
     * Determine if the user is authorized to make this request.
     */

}
