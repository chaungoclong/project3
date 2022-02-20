<?php

namespace App\Http\Requests\Admin\Role;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteFormRequest extends FormRequest
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
        $cannotDelete = [
            Role::where('name', 'admin')->first()->id,
        ];
        return [
            'id' => [Rule::notIn($cannotDelete)],
        ];
    }

    public function messages()
    {
        return [
            'id.not_in' => 'Cannot delete admin role',
        ];
    }
}
