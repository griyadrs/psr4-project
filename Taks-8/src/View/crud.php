<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Category CRUD</title>
    <link rel="stylesheet" href="../CSS/crud.css">
</head>

<body>

    <div class="container">
        <h1>Product Category Management</h1>

        <h2>Add or Edit Category</h2>
        <form action="/product-category/store" method="POST">
            <input type="text" name="name" placeholder="Enter Category Name" required>
            <button type="submit">Save Category</button>
        </form>

        <h2>Category List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Electronics</td>
                    <td>
                        <form action="/product-category/update/1" method="POST" style="display:inline;">
                            <button type="submit">Edit</button>
                        </form>
                        <form action="/product-category/delete/1" method="POST" style="display:inline;">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

</body>

</html>