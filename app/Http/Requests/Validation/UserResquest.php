<?php

namespace App\Http\Requests\Validation;

use App\Http\Requests\BaseRequest;
/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="name", type="string", example="huunv"),
 *          @OA\Property(property="email", type="string",format="email", example="huunv@gmail.com"),
 *          @OA\Property(property="password", type="string", example="123456"),
 *          @OA\Property(property="passwordConfirm", type="string", example="123456"),
 *      }
 * )
 */
class UserRequest extends BaseRequest
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
            'email'            => 'unique:users|email',
            'sex'              => 'in:1,2,3',
            'phone'            => 'numeric',
        ];
    }
}
