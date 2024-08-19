<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\ProductCategory;
use App\Exections\ValidationException;

$productCategoryModel = new ProductCategory();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate and sanitation input
    $validatedData = ValidationException::validate($_POST, [
        'name' => 'string'
    ]);

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                $productCategoryModel->create([
                    'name' => $validatedData['name']
                ]);
                break;

            case 'update':
                $id = ValidationException::validateInt($_GET['id']);
                if ($id !== null) {
                    $productCategoryModel->update($id, [
                        'name' => $validatedData['name']
                    ]);
                }

                break;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = ValidationException::validateInt($_GET['id']);
    if ($id !== null) {
        $productCategoryModel->delete($id);
    }
}

$data = $productCategoryModel->findAll();

function displayData($data)
{
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Created At</th><th>Updated At</th><th>Actions</th></tr>";
    foreach ($data as $item) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($item['created_at'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($item['updated_at'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td> 
            <a href='crud.php?action=edit&id=" . 
                htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') . "'>Edit</a> | 
            <a href='crud.php?action=delete&id=" .
                htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') . "'>Delete</a> </td>";
        echo "</tr>";
    }
    echo "</table>";
}

displayData($data);
?>

<!-- Form for Adding New Item -->
<h2>Add New Item</h2>
<form method="POST" action="crud.php?action=add">
    <label for   ="name">Name:</label>
    <input type  ="text" name="name" id="name" required>
    <button type ="submit">Add</button>
</form>

<!-- Form for Editing Item -->
<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') { 
    $id   = ValidationException::validateInt($_GET['id']);
    $item = $productCategoryModel->findOne($id);

    if ($item): ?>
    <h2>Edit Item</h2>
    <form method="POST" action="crud.php?action=update&id=
        <?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <label for="update">Name:</label>
            <input type="text" name="name" id="update" 
            value="<?php echo htmlspecialchars(
                $item['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <button type="submit">Update</button>
    </form>
<?php endif; } ?>