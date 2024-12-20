<?php

namespace App\Actions;

use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateClientAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $data): Client
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|string|unique:clients',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return Client::create($validator->validated());
    }
}
