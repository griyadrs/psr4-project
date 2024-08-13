<?php

namespace App\Controllers;

class ProductCategoryController
{
    private $categories = [
        1 => 'Electronics'
    ];

    public function index()
    {
        // View list category product
        foreach ($this->categories as $id => $name) {
            echo "ID: $id, Name: $name<br>";
        }
    }

    public function store()
    {
        // Tambah kategori produk
        echo "Tambah kategori produk";
    }

    public function show($id)
    {
        // Tampilkan detail kategori produk berdasarkan ID
        echo "Detail kategori produk dengan ID: " . $id;
    }

    public function update($id)
    {
        // Perbarui kategori produk berdasarkan ID
        echo "Update kategori produk dengan ID: " . $id;
    }

    public function delete($id)
    {
        // Hapus kategori produk berdasarkan ID
        echo "Hapus kategori produk dengan ID: " . $id;
    }
}
