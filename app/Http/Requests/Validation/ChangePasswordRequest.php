<?php

namespace App\Http\Requests\Validation;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="currentPassword", type="string", example="huunv"),
 *          @OA\Property(property="newPassword", type="string", example="123456"),
 *          @OA\Property(property="confirmNewPassword", type="string", example="123456"),
 *      }
 * )
 */
class ChangePasswordRequest extends BaseRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'currentPassword'      => 'required|string',
            'newPassword'          => 'required|string',
            'confirmNewPassword'  => 'required|string|same:new_password',
        ];
    }
}
