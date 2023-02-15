<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class BaseRequest extends FormRequest
{
    public function failedValidation(ValidatorContract $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        foreach ($errors as $key => $value) {
            $errors[$key] = reset($value);
        }
        $requests = [
            "status"   => 'errors',
            "message"  => $errors
        ];
        throw new HttpResponseException(response()->json($requests, JsonResponse::HTTP_BAD_REQUEST));
    }

    public function jsonError($message) {
        return response()->json([
            'status'  => 'error',
            'message' => $message
        ]);
    }
}
