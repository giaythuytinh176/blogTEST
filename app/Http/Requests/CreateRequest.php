<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->userCan('page-user-admin')) {
            return [
                'title' => 'required|string|max:255',
                'summary' => 'required|string',
                'content' => 'required|string',
                'published_at' => 'required|date',
                'status' => 'required|string|max:33',
            ];
        } else {
            return [
                'title' => 'required|string|max:255',
                'summary' => 'required|string',
                'content' => 'required|string',
            ];
        }
    }

    public function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }
}
