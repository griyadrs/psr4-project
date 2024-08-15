<?php

namespace App\Controllers;

use App\Models\ProductCategory;

class ProductCategoryController
{
    public function index()
    {
        $categories = (new ProductCategory)->findAll();

        return json_encode([
            'data' => $categories
        ]);
    }

    public function store()
    {
        $data = $_POST;

        $category = new ProductCategory();
        $response = $category->create($data);

        return json_encode([
            'data' => $response
        ]);
    }

    public function show($id)
    {
        $category = (new ProductCategory)->findOne($id);

        return json_encode([
            'data' => $category
        ]);
    }

    public function update($id)
    {
        $data = $_POST;

        $category = new ProductCategory();
        $response = $category->update($id, $data);

        return json_encode([
            'data' => $response
        ]);
    }

    public function delete($id)
    {
        $category = new ProductCategory();
        $category->delete($id);

        return json_encode([
            'message' => 'success'
        ]); 
    }

}