<?php

namespace App\Actions;

use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateClientAction
{
    /**
     * Update the client data.
     */
    public function execute(Client $client, array $data): Client
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|string|email|unique:clients,email,' . $client->id,
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $client->update($validator->validated());

        return $client;
    }
}

