<?php

namespace Src\BoundedContext\Client\Application\Validations;
use Src\BoundedContext\Client\Application\Exceptions\ValidationException;

class CreateClientValidation
{
    /**
     * @throws ValidationException
     */
    public static function validate(array $data): void
    {
        $issetCpf = isset($data['cpf']);

        $validator = validator($data, [
            'name' => $issetCpf ? 'sometimes|min:3' : 'required|min:3',
            'email' => $issetCpf ? 'sometimes|email' : 'required|email',
            'cpf' => isset($data['name']) && isset($data['email']) ? 'min:11' : 'required|min:11',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
    }
}
