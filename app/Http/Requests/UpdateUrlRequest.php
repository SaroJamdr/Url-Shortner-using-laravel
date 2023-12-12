<?php

namespace App\Http\Requests;

use App\Models\Url;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $url_id = $this->route()->id;
        $urls = Url::findOrFail($url_id);
        
        return $urls->user_id == auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->method() != "get"){
            return [
                'url'=>'required|url|max:2048'
            ];
        }
        return[];
    }
}
