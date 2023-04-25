<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|max:1000',
            'post_id' => 'exists:App\Models\Post,id',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'A comment is required',
            'comment.max' => 'A comment cannot exceed 1000 characters',
            'post_id.exists' => 'You must sent a valid post'
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You must be logged in to write comments');
    }
}
