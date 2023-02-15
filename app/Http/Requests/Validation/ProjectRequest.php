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
class ProjectRequest extends BaseRequest
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
            'title'            => 'required|unique:projects|string',
            'description'      => 'required|string',
            'public_flag'      => 'required|in:1,2',
            'status'           => 'required|in:1,2,3',
            'start_date'       => 'required',
            'closed_date'      => 'required',
        ];
    }
}
