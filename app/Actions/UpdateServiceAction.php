<?php

namespace App\Actions;

use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateServiceAction
{
    public function execute(Service $service, array $data): Service
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $service->update($validator->validated());

        return $service;
    }
}
