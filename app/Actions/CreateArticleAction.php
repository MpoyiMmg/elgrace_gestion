<?php

namespace App\Actions;

use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateArticleAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $data): Article
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => '',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return Article::create($validator->validated());
    }
}
