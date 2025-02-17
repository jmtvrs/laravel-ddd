<?php

declare(strict_types=1);

namespace Web\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

trait FailedValidationTrait
{
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()
                ->json([
                    'success' => FALSE,
                    'message' => 'Validation errors',
                    'data' => $validator->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
