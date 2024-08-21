<?php

namespace App\Controllers;

use App\Libraries\Request;
use App\Libraries\Validation;
use App\Models\ProductCategory;
use App\Exceptions\ValidationException;

class ProductCategoryController
{
    private $productCategoryModel;

    public function __construct()
    {
        $this->productCategoryModel = new ProductCategory();
    }

    public function index()
    {
        try {
            $categories = $this->productCategoryModel->findAll();

            return json_encode(['data' => $categories]);
        } catch (ValidationException $e) {
            $this->handleError($e);
            
            return json_encode(['error' => 'Unable to fetch categories.']);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate($request->allInput(), [
                'name' => ['required', 'string']
            ]);
            $data     = $request->allInput();
            $response = $this->productCategoryModel->create($data);

            return json_encode(['data' => $response]);
        } catch (ValidationException $e) {
            $this->handleError($e);

            return json_encode(['error' => 'Unable to create category.']);
        }
    }

    public function show(int $id)
    {
        try {
            $validatedId = Validation::validateInt($id);
            $category    = $this->productCategoryModel->findOne($validatedId);

            return json_encode(['data' => $category]);
        } catch (ValidationException $e) {
            $this->handleError($e);

            return json_encode(['error' => 'Unable to fetch category.']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedId = Validation::validateInt($id);

            // if ($validatedId == null) {
            //     throw new Validation('Invalid ID provided.');
            // }

            $request->validate($request->allInput(), [
                'name' => ['required', 'string']
            ]);
            $data     = $request->allInput();
            $response = $this->productCategoryModel->update($validatedId, $data);

            return json_encode(['data' => $response]);
        } catch (ValidationException $e) {
            $this->handleError($e);
            
            return json_encode(['error' => 'Unable to update category.']);
        }
    }

    public function delete(int $id)
    {
        try {
            $validatedId = Validation::validateInt($id);

            // if ($validatedId === null) {
            //     throw new Validation('Invalid ID provided.');
            // }

            $this->productCategoryModel->delete($validatedId);

            return json_encode(['message' => 'Category deleted successfully.']);

        } catch (ValidationException $e) {
            $this->handleError($e);
            
            return json_encode(['error' => 'Unable to delete category.']);
        }
    }

    protected function handleError(ValidationException $e)
    {
        error_log($e->getMessage());
    }
}
