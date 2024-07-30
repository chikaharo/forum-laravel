<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'image' => ['nullable', 'string'],
            'title' => ['required', 'string'],
            // 'forum_id' => ['required', 'exists:forum,id'],
            'user_id' => ['required', 'exists:users,id'],
            'topic_id' => ['required', 'exists:topics,id']
        ];
    }
}
