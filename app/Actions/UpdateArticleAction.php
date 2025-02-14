<?php

namespace App\Actions;

use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateArticleAction
{
    public function execute(Article $article, array $data): Article
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $article->update($validator->validated());

        return $article;
    }
}
