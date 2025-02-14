<?php

namespace App\Actions;

use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateServiceAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $data): Service
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            // 'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return Service::create($validator->validated());
    }
}
