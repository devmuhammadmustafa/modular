<?php

namespace Modules\Category\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $return= [
            ...$this->getTitles()
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
        $title=[];
        foreach (config('lang.langs') as $lang){
          $title['title_'.$lang]=['required'];
        }
        return $title;
    }

    /**
     * Determine if the user is authorized to make this request.
     */

}
