<?php require "partials/head.php"; ?>
<?php require "partials/nav.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #F5F5DC;
    }

    .containertab {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        flex-wrap: wrap;
        text-align: center;
    }

    .stock-container {
        width: 18%;
        padding: 15px;
        margin: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .total-products-container,
    .low-stock-container,
    .zero-stock-container,
    .most-stock-container,
    .out-of-stock-container {
        width: 18%;
        margin: 10px;
        padding: 5px;
        border-radius: 8px;
    }

    .total-products-container {
        background-color: #5e8fbf;
        color: #fff;
    }

    .low-stock-container {
        background-color: #ff6347;
        color: #fff;
    }

    .zero-stock-container {
        background-color: #1e90ff;
        color: #fff;
    }

    .out-of-stock-container {
        background-color: #ff0000;
        color: #fff;
    }

    .most-stock-container {
        background-color: #4caf50;
        color: #fff;
    }

    table {
        width: 70%;
        border-collapse: collapse;
        border: #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        color: #333;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 15px;
        text-align: left;
        vertical-align: middle;
    }

    th {
        background-color: #2473c0;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }


    .button {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .button.add-button {
        background-color: #2473c0;
        color: white;
        margin-right: 5px;
    }

    .button.edit-button {
        background-color: green;
        color: white;
    }

    .button.delete-button {
        background-color: #FF6347;
        color: white;
    }

    /* Style sa edit form */
    .edit-form {
        display: none;
        text-align: center;
    }

    .edit-form input {
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .edit-form select {
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .edit-form button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background-color: #008CBA;
        color: white;
        cursor: pointer;
    }

    .action-buttons {
        display: flex;
    }

    .button-form {
        display: table-row;
        text-align: center;
        vertical-align: middle;
    }

    /*STYLE FORDA OVER LAY FORM */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        overflow: auto;
        box-sizing: border-box;
    }

    .overlay-content {
        max-height: 100%;
        /* Adjust maximum height as needed */
        max-width: 100%;
        /* Adjust maximum width as needed */
        overflow-y: auto;
    }

    /*default table no design */
    .tableDefault,
    .tableDefault tr:nth-child(even) {
        border: none;
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        /* Add borders for demonstration; you can remove or modify this */
        padding: 8px;
        /* Add padding for better readability; you can adjust this */
        text-align: left;
        color: black;
        background-color: transparent;
        box-shadow: none;

        /* Optional: Alternate background color for headers */
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // toggle row of edit inventory data 
    function toggleEditForm(formId) {
        var editForm = document.getElementById(formId);
        editForm.style.display = (editForm.style.display === 'none' || editForm.style.display === '') ? 'table-row' : 'none';
    }

    //toggle row of edit category
    function toggleEditCategoryForm(categoryId) {
        var categoryForm = document.getElementById(categoryId);
        categoryForm.style.display = (categoryForm.style.display === 'none' || categoryForm.style.display === '') ? 'table-row' : 'none';
    }

    // add inventory button

    document.addEventListener('DOMContentLoaded', function() {
        const addForm = document.getElementById('addForm');
        const overlay = document.getElementById('overlay');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const body = document.body;
        // Initially hide the overlay form
        overlay.style.display = 'none';

        // Show the overlay form when the button is clicked
        addForm.addEventListener('click', function() {
            overlay.style.display = 'flex';
            body.style.overflow = 'hidden';
        });

        // Close the overlay form when the close button is clicked
        closeFormBtn.addEventListener('click', function() {
            overlay.style.display = 'none';
            body.style.overflow = 'visible';
        });
    });


    //update all invenrtory button
    document.addEventListener('DOMContentLoaded', function() {
        const updateInventory = document.getElementById('updateInventoryBtn');
        const overlayInventory = document.getElementById('updateInventory');
        const closeUpdateFormBtn = document.getElementById('closeUpdateFormBtn');
        const body = document.body;
        // Initially hide the update ingredients form
        overlayInventory.style.display = 'none';

        // Show the overlay form when the button is clicked
        updateInventory.addEventListener('click', function() {
            overlayInventory.style.display = 'flex';
            body.style.overflow = 'hidden';
        });

        // Close the overlay form when the close button is clicked
        closeUpdateFormBtn.addEventListener('click', function() {
            overlayInventory.style.display = 'none';
            body.style.overflow = 'visible';
        });
    });

    //inventory category settings

    document.addEventListener('DOMContentLoaded', function() {
        const categoryInventory = document.getElementById('categoryInventory');
        const overlayCategory = document.getElementById('inventoryCategory');
        const closeCategoryFormBtn = document.getElementById('closeCategoryForm');
        const body = document.body;
        // Initially hide the overlay form
        overlayCategory.style.display = 'none';

        // Show the overlay form when the button is clicked
        categoryInventory.addEventListener('click', function() {
            overlayCategory.style.display = 'flex';
            body.style.overflow = 'hidden';
        });

        // Close the overlay form when the close button is clicked
        closeCategoryFormBtn.addEventListener('click', function() {
            overlayCategory.style.display = 'none';
            body.style.overflow = 'visible';
        });
    });

    //alert add
    function confirmAdd() {
        return confirm("Are you sure you want to add this inventory?");
    }


    //alert update all inventory
    function confirmUpdate() {
        return confirm("Are you sure you want to apply this update to all inventory items?");
    }


    //alert delete
    function confirmDelete() {
        return confirm("Are you sure you want to delete this inventory item?");
    }

    //alert update current inventory
    function confirmEdit() {
        return confirm("Are you sure you want to edit this inventory item?");
    }
</script>


<!--hidden add inventory form-->
<div class="overlay" id="overlay">
    <div class="overlay-content">
        <div class="info-box">
            <button id="closeFormBtn" class="button delete-button">X</button>
            <h2>Add New Inventory</h2>
            <form method="post" action="/admin_dashboard/inventory" id="addInventoryForm" onsubmit="return confirmAdd()">
                <div class="form-group">
                    <label for="new_item">Inventory Item:</label>
                    <input type="text" class="form-control" name="new_item" placeholder="Inventory Item:" required>
                </div>
                <div class="form-group">
                    <label for="new_type">Inventory Type:</label>
                    <select name="new_type" class="form-control" id="new_type" required>
                        <option value="" selected disabled>Inventory Type:</option>
                        <?php foreach ($categoryInventoryData as $category) : ?>
                            <option value="<?= $category['inventory_category'] ?>">
                                <?= $category['inventory_category'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="new_quantity">Quantity: </label>
                    <input type="number" class="form-control" name="new_quantity" placeholder="Quantity: " required>
                </div>
                <div class="form-group">
                    <label for="new_unit">Unit: </label>
                    <input type="text" class="form-control" name="new_unit" placeholder="Unit:" required>
                </div>
                <button type="submit" name="submit_add" id="addButton" class="button add-button" style="width:100%;">Add</button>
        </div>
        </form>
    </div>
</div>

<!--hidden update all inventory form-->
<div class="overlay" id="updateInventory">
    <div class="overlay-content">
        <div class="info-box">
            <button id="closeUpdateFormBtn" class="button delete-button">X</button>
            <h2>Update All Inventory</h2>
            <form method="post" action="/admin_dashboard/inventory" id="updateInventoryForm" onsubmit="return confirmUpdate()">
                <div>
                    <table class="tableDefault">
                        <tr class="tableDefault">
                            <th class="tableDefault">Item</th>
                            <th class="tableDefault">Current Quantity</th>
                            <th class="tableDefault">New Quantity</th>
                        </tr>
                        <?php foreach ($inventoryData as $inventoryDataRow) : ?>
                            <tr class="tableDefault">
                                <td class="tableDefault">
                                    <?= $inventoryDataRow['inventory_item'] ?>
                                </td>
                                <td class="tableDefault">
                                    <?= $inventoryDataRow['quantity'] ?>
                                </td>
                                <td class="tableDefault">
                                    <input type="number" name="<?= "newQuantity" . $inventoryDataRow['inventory_id'] ?>" placeholder="Edit Quantity" value="<?= $inventoryDataRow['quantity'] ?>" required>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <br>
                <button type="submit" name="submit_update_all" id="applyUpdateButton" class="button add-button" style="width:100%;">Apply Update</button>
                <br><br>
            </form>
        </div>
    </div>
</div>

<!--hidden inventory category form-->
<div class="overlay" id="inventoryCategory">
    <div class="overlay-content">
        <div class="info-box">
            <button id="closeCategoryForm" class="button delete-button">X</button>
            <h2>Inventory Categories</h2>
            <div class="form-group">
                <table style="margin: auto;">
                    <?php foreach ($categoryInventoryData as $category) : ?>
                        <tr>

                            <td>
                                <?= $category['inventory_category'] ?>
                            </td>
                            <td>
                                <form method="post" action="/admin_dashboard/inventory" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    <input type="hidden" name="update_category_id" value="<?= $category['categoryInventory_id'] ?>">
                                    <button type="button" class="button edit-button" onclick="toggleEditCategoryForm('editCategory<?= $category['categoryInventory_id'] ?>')">✎</button>
                                    <input type="hidden" name="delete_category_id" value="<?= $category['categoryInventory_id'] ?>">
                                    <button type="submit" name="categoryDelete" class="button delete-button">✖</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="edit-form" id="editCategory<?= $category['categoryInventory_id'] ?>">
                            <td colspan="2">
                                <form method="post" action="" onsubmit="return confirm('Are you sure you want to change this category?');">
                                    <input type="hidden" name="update_category_id" value="<?= $category['categoryInventory_id'] ?>">
                                    <input type="text" name="update_inventoryCategory" value="<?= $category['inventory_category'] ?>" required>
                                    <button type="submit" name="update_category" class="button edit-button">💾</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <h2>Add New Category</h2>
            <form method="post" action="/admin_dashboard/inventory" onsubmit="return confirm('Are you sure you want to add this category?');">
                <div class="form-group">
                    <label for="new_category">Inventory Item:</label>
                    <input type="text" class="form-control" name="new_category" placeholder="Category Name" required>
                </div>
                <button type="submit" name="addCategory" class="button add-button" style="width:100%;">Add</button>
            </form>
        </div>
    </div>
</div>


<!--Visible Main-->
<div class="dashboard">
    <div class="content">
        <h2>Inventory
            <?php echo " (" . $_SESSION['user']['email'] . " the " . $_SESSION['user']['position'] . ") " ?>
        </h2>

        <div>
            <div class="containertab">
                <div class="stock-container total-products-container">
                    <h4><i class="fa fa-shopping-cart"></i> Total Products</h4>
                    <p>
                        <?php echo $totalProducts; ?>
                    </p>
                </div>
                <div class="stock-container low-stock-container">
                    <h4><i class="fa fa-exclamation-triangle"></i> Low Stock</h4>
                    <p>
                        <?php echo !empty($lowStockData) ? $lowStockData[0]['lowStock'] : 0; ?>
                    </p>
                </div>

                <div class="stock-container out-of-stock-container">
                    <h4><i class="fa fa-ban"></i> Out of Stock</h4>
                    <p>
                        <?php echo !empty($outOfStockData) ? $outOfStockData[0]['out_of_stock'] : 0; ?>
                    </p>
                </div>
                <div class="stock-container most-stock-container">
                    <h4><i class="fa fa-check-circle"></i> Most Stock</h4>
                    <p>
                        <?php echo !empty($mostStockData) ? $mostStockData[0]['most_stock'] : 0; ?>
                    </p>
                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: space-between;">
                <button type="button" class="button add-button" id="addForm">+ Add
                    Inventory</button>
                <button type="button" class="button add-button" id="updateInventoryBtn" style="margin-left: auto;">Update All
                    Inventory</button>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Inventory Item</th>
                            <th>Item Type
                                <button type="button" id="categoryInventory" style="background-color:transparent; border:none; padding:none;">⚙️</button>
                            </th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inventoryData as $item) : ?>
                            <tr>
                                <td>
                                    <?= $item['inventory_item'] ?>
                                </td>
                                <td>
                                    <?= $item['item_type'] ?>
                                </td>
                                <td>
                                    <?= $item['quantity'] ?>
                                </td>
                                <td>
                                    <?= $item['unit'] ?>
                                </td>

                                <td class="action-buttons">
                                    <form method="post" action="/admin_dashboard/inventory" class="button-form" onsubmit="return confirmDelete()">
                                        <input type="hidden" name="edit_item_id" value="<?= $item['inventory_id'] ?>">
                                        <button type="button" class="button edit-button" onclick="toggleEditForm('editForm<?= $item['inventory_id'] ?>')">✎</button>
                                        <input type="hidden" name="delete_item_id" value="<?= $item['inventory_id'] ?>">
                                        <button type="submit" name="submit_delete" class="button delete-button">✖</button>
                                    </form>
                                </td>
                            </tr>
                            <tr class="edit-form" id="editForm<?= $item['inventory_id'] ?>">
                                <td colspan="7">
                                    <form method="post" action="/admin_dashboard/inventory" onsubmit="return confirmEdit()">
                                        <input type="hidden" name="edit_item_id" value="<?= $item['inventory_id'] ?>">
                                        <input type="text" name="edited_item" placeholder="Edit Item" value="<?= $item['inventory_item'] ?>" required>
                                        <select name="edited_type" id="edited_type" required>
                                            <?php foreach ($categoryInventoryData as $category) : ?>
                                                <option value="<?= $category['inventory_category'] ?>" <?php echo ($item['item_type'] == $category['inventory_category']) ? 'selected' : ''; ?>>
                                                    <?= $category['inventory_category'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="number" name="edited_quantity" placeholder="Edit Quantity" value="<?= $item['quantity'] ?>" required>
                                        <input type="text" name="edited_unit" placeholder="Edit Unit" value="<?= $item['unit'] ?>" required>
                                        <button type="submit" name="submit_edit" class="button edit-button">💾</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>