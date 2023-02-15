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
class RegisterRequest extends BaseRequest
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
            'name'             => 'required|string',
            'email'            => 'required|unique:users|email|string',
            'password'         => 'required|string',
            'passwordConfirm'  => 'required|string|same:password',
            'sex'              => 'required|in:1,2,3',
            'birthday'         => 'required',
            'phone'            => 'required|numeric',
        ];
    }
}