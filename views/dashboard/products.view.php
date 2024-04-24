<?php

use Core\App;
use Core\Database;

$db = App::resolve('Core\Database');
?>

<?php require "partials/head.php"; ?>
<?php require "partials/nav.php"; ?>


<link rel="stylesheet" href="/Dashboard/css/products.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!--add form overlay-->
<?php if (isset($errors['body'])) : ?>
    <h2 style="text-align: center; color: red;"><?= $errors['body'] ?></h2>
<?php endif; ?>
<div class="overlay" id="overlay">
    <div class="overlay-content">
        <div class="info-box">
            <button id="closeFormBtn" class="button delete-button">X</button>
            <h2>Add New Product</h2>
            <form method="post" enctype="multipart/form-data" id="addProductForm">
                <div class="form-group">
                    <label for="new_product">Product Name:</label>
                    <input type="text" class="form-control" name="new_product" placeholder="Product Name:" required>
                </div>
                <div class="form-group">
                    <label for="new_productDescription">Product Description:</label>
                    <textarea name="new_productDescription" class="form-control" rows="4" cols="50" placeholder="Product Description:" required></textarea>
                </div>
                <div class="form-group">
                    <label for="new_price">Price: </label>
                    <input type="number" step="0.01" class="form-control" name="new_price" placeholder="Price: 0.00" required>
                </div>

                <div class="form-group">
                    <label for="fileToUpload">Image: </label>
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                </div>

                <div class="form-group">
                    <label for="new_category">Category: </label>
                    <select name="new_category" class="form-control" id="new_category" required>
                        <option value="" selected disabled>
                            Category:</option>
                        <?php foreach ($categoryProductData as $category) : ?>
                            <option value="<?= $category['category'] ?>">
                                <?= $category['category'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="submit_add" id="addButton" class="button add-button" style="width:100%;">Add</button>
            </form>
        </div>
    </div>
</div>

<!--provide product Ingredients-->
<?php foreach ($productsData as $products) : ?>
    <div class="overlay" id="ingredientsForm<?= $products['product_id'] ?>" style="overflow:auto;">
        <div class="overlay-content">
            <div class="info-box">
                <button type="button" onclick="closeIngredientForm('ingredientsForm<?= $products['product_id'] ?>')" class="button delete-button">X</button>
                <h2>Insert Ingredients for this Product</h2>

                <div>
                    <h4><b>Product Name:</b>
                        <p style="color:#333; display: inline;">
                            <?php echo $products['product_name']; ?>
                        </p>
                    </h4>

                </div>
                <div>
                    <h4><b>Product Description:</b>
                        <p style="color:#333;">
                            <?php echo $products['product_description']; ?>
                        </p>
                    </h4>

                </div>
                <div>
                    <h4><b>Price:</b>
                        <p style="color:#333; display: inline;">₱
                            <?php echo $products['price']; ?>
                        </p>
                    </h4>

                </div>
                <div>
                    <h4><b>Category:</b>
                        <p style="color:#333; display: inline;">
                            <?php echo $products['category']; ?>
                        </p>
                    </h4>
                </div>
                <form method="post" action="">
                    <div id="dropdowns-container<?= $products['product_id'] ?>">
                        <!-- Dropdowns ingredients will be added here -->
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="insert_product_id" value="<?= $products['product_id'] ?>">
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="addDropdown('dropdowns-container<?= $products['product_id'] ?>')">Add
                            Dropdown</button>
                    </div>
                    <button type="submit" name="submit_insert" class="button add-button">Insert
                        Ingredients</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!--Show and for reseting product Ingredients-->
<?php foreach ($productsData as $products) : ?>
    <div class="overlay" id="ingredientsList<?= $products['product_id'] ?>" style="overflow:auto;">
        <div class="overlay-content">
            <div class="info-box">
                <button type="button" onclick="closeIngredientsList('ingredientsList<?= $products['product_id'] ?>')" class="button delete-button">X</button>
                <h2>Insert Ingredients for this Product</h2>

                <div>
                    <h4><b>Product Name:</b>
                        <p style="color:#333; display: inline;">
                            <?php echo $products['product_name']; ?>
                        </p>
                    </h4>
                </div>
                <div>
                    <h4><b>Product Description:</b>
                        <p style="color:#333;">
                            <?php echo $products['product_description']; ?>
                        </p>
                    </h4>

                </div>
                <div>
                    <h4><b>Price:</b>
                        <p style="color:#333; display: inline;">₱
                            <?php echo $products['price']; ?>
                        </p>
                    </h4>

                </div>
                <div>
                    <h4><b>Category:</b>
                        <p style="color:#333; display: inline;">
                            <?php echo $products['category']; ?>
                        </p>
                    </h4>
                </div>
                <div>
                    <form method="post" action="">
                        <div id="dropdowns-container<?= $products['product_id'] ?>">
                            <table class="tableDefault">
                                <?php
                                $sql = "SELECT * FROM tblproducts_inventory PI 
                                                JOIN tblinventory I ON PI.inventory_id = I.inventory_id 
                                                WHERE products_id = $products[product_id]";
                                $currentIngredientsData = $db->query($sql)->get();
                                ?>
                                <tr class="tableDefault">
                                    <th class="tableDefault">Ingredients</th>
                                    <th class="tableDefault">Quantity</th>
                                </tr>
                                <tr class="tableDefault">
                                    <?php foreach ($currentIngredientsData as $currentIngredients) : ?>
                                        <?php if ($currentIngredients['quantity'] <= 0) : ?>
                                            <td class="tableDefault" style="background-color: rgba(255, 99, 71, 0.5);">
                                                <?php echo $currentIngredients['inventory_item']; ?>
                                            </td>
                                            <td class="tableDefault" style="background-color: rgba(255, 99, 71, 0.5);">
                                                <?php echo $currentIngredients['quantity']; ?>
                                            </td>
                                        <?php else : ?>
                                            <td class="tableDefault">
                                                <?php echo $currentIngredients['inventory_item']; ?>
                                            <td class="tableDefault">
                                                <?php echo $currentIngredients['quantity']; ?>
                                            </td>
                                        <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            </table>

                        </div>
                        <div class="form-group">
                            <input type="hidden" name="deleteProductIngredients" value="<?= $products['product_id'] ?>">
                        </div>
                        <button type="submit" name="reset_ingredients" class="button delete-button" style="width:100%;">Reset
                            Ingredients</button>
                    </form>
                    </h4>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!--hidden product category form-->
<div class="overlay" id="productCategory">
    <div class="overlay-content">
        <div class="info-box">
            <button id="closeProductForm" class="button delete-button">X</button>
            <h2>Product Categories</h2>
            <div class="form-group">
                <table style="margin: auto;">
                    <?php foreach ($categoryProductData as $category) : ?>
                        <tr>
                            <td>
                                <?= $category['category'] ?>
                            </td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="update_category_id" value="<?= $category['categoryProduct_id'] ?>">
                                    <button type="button" class="button edit-button" onclick="toggleEditCategoryForm('editCategory<?= $category['categoryProduct_id'] ?>')">✎</button>
                                    <input type="hidden" name="delete_category_id" value="<?= $category['categoryProduct_id'] ?>">
                                    <button type="submit" name="categoryDelete" class="button delete-button">✖</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="edit-form" id="editCategory<?= $category['categoryProduct_id'] ?>">
                            <td colspan="2">
                                <form method="post" action="">
                                    <input type="hidden" name="update_category_id" value="<?= $category['categoryProduct_id'] ?>">
                                    <input type="text" name="update_productCategory" value="<?= $category['category'] ?>" required>
                                    <button type="submit" name="update_product" class="button edit-button">💾</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <form method="post" action="">
                <div class="form-group">
                    <label for="new_category">Inventory Item:</label>
                    <input type="text" class="form-control" name="new_category" placeholder="Category Name" required>
                </div>
                <button type="submit" name="addCategory" class="button add-button" style="width:100%;">Add</button>
            </form>
        </div>
    </div>
</div>

<!--Manage Promos-->
<div class="overlay" id="managePromos">
    <div class="overlay-content">
        <div class="info-box" style="width:fit-content; max-width:100%;">
            <button id="closeManagePromosBtn" class="button delete-button">X</button>
            <h2>Manage Promos</h2>
            <div class="form-group">
                <table style="margin: auto;">
                    <tr>
                        <th>Promo Name</th>
                        <th>Promo Description</th>
                        <th>Promo Code</th>
                        <th>Value</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($promosData as $promos) : ?>

                        <tr>

                            <td>
                                <?= $promos['promoname'] ?>
                            </td>
                            <td>
                                <?= $promos['promodesc'] ?>
                            </td>
                            <td>
                                <?= $promos['promocode'] ?>
                            </td>
                            <td>
                                <?= $promos['value'] ?>
                            </td>
                            <td>
                                <?= $promos['startdate'] ?>
                            </td>
                            <td>
                                <?= $promos['enddate'] ?>
                            </td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="update_promo_id" value="<?= $promos['promoid'] ?>">
                                    <button type="button" class="button edit-button" onclick="toggleEditCategoryForm('editPromo<?= $promos['promoid'] ?>')">✎</button>
                                    <input type="hidden" name="delete_promo_id" value="<?= $promos['promoid'] ?>">
                                    <button type="submit" name="promoDelete" id="deletePromo" class="button delete-button">✖</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="edit-form" id="editPromo<?= $promos['promoid'] ?>">
                            <td colspan="7">
                                <form method="post" action="">
                                    <input style="width: auto; max-width:150px;" type="hidden" name="update_promo_id" value="<?= $promos['promoid'] ?>" required>
                                    <input style="width: auto; max-width:150px;" type="text" name="update_promoName" value="<?= $promos['promoname'] ?>" required>
                                    <textarea style="width: auto; max-width:150px;" name="update_promoDesc" cols="30" rows="3" required><?= $promos['promodesc'] ?></textarea>
                                    <input style="width: auto; max-width:150px;" type="text" name="update_promoCode" value="<?= $promos['promocode'] ?>" required>
                                    <input style="width: auto; max-width:150px;" type="number" step="0.01" name="update_promoValue" value="<?= $promos['value'] ?>" required>
                                    <input style="width: auto; max-width:150px;" type="date" name="update_promoStartDate" value="<?= $promos['startdate'] ?>" required>
                                    <input style="width: auto; max-width:150px;" type="date" name="update_promoEndDate" value="<?= $promos['enddate'] ?>" required>
                                    <button type="submit" name="update_promo" class="button edit-button">💾</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <h2>Add New Promo</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="new_promoName">Promo Name:</label>
                    <input type="text" class="form-control" name="new_promoName" placeholder="Enter promo name" required>
                    <label for="new_promoDesc">Promo Description:</label>
                    <textarea class="form-control" name="new_promoDesc" cols="30" rows="5" placeholder="Enter promo description" required></textarea>
                    <label for="new_promoCode">Promo Code:</label>
                    <input type="text" class="form-control" name="new_promoCode" placeholder="Enter promo code" required>
                    <label for="new_value">Value:</label>
                    <input type="number" step="0.01" class="form-control" name="new_value" placeholder="Enter value" required>
                    <label for="new_startDate">Start Date:</label>
                    <input type="date" class="form-control" name="new_startDate" placeholder="Enter start date" required>
                    <label for="new_endDate">End Date:</label>
                    <input type="date" class="form-control" name="new_endDate" placeholder="Enter end date" required>
                </div>
                <button type="submit" name="addPromo" class="button add-button" style="width:100%;">Add</button>
            </form>
        </div>
    </div>
</div>


<!--Visible Main-->
<div class="dashboard">
    <div class="content">
        <h2>Products Listing
            <?php echo " (" . $_SESSION['user']['email'] . " the " . $_SESSION['user']['position'] . ") " ?>
        </h2>
        <div style="display: flex; justify-content: space-between;">
            <button type="button" class="button add-button" id="addForm">+ Add
                Products</button>
            <button type="button" class="button add-button" id="managePromosBtn" style="margin-left: auto;">Manage
                Promos</button>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Discription</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Category<button type="button" id="categoryProduct" onclick="toggleForm()" style="background-color:transparent; border:none; padding:none;">⚙️</button>
                        </th>
                        <th>Product Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productsData as $products) : ?>
                        <tr>
                            <td>
                                <?= $products['product_name'] ?>
                            </td>
                            <td>
                                <?= $products['product_description'] ?>
                            </td>
                            <td style="text-align:center;">
                                <?= $products['price'] ?>
                            </td>
                            <?php if ($products['status'] == NULL) : ?>
                                <td style="text-align:center;">
                                    <button type="button" class="button add-button" onclick="toggleIngredientForm('ingredientsForm<?= $products['product_id'] ?>')">Insert
                                        Ingredients</button>
                                </td>
                            <?php else : ?>
                                <td style="text-align:center;">
                                    <?php if ($products['status'] == "Available") : ?>
                                        <button type="button" class="button edit-button" onclick="toggleIngredientsList('ingredientsList<?= $products['product_id'] ?>')">
                                            <?= $products['status'] ?>
                                        </button>
                                    <?php else : ?>
                                        <button type="button" class="button delete-button" onclick="toggleIngredientsList('ingredientsList<?= $products['product_id'] ?>')">
                                            <?= $products['status'] ?>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>

                            <td>
                                <?= $products['category'] ?>
                            </td>

                            <td>
                                <?php if (isset($products['image'])) : ?>
                                    <img height="70px" src="/uploads/<?= $products['image'] ?>" alt="">
                                <?php else : ?>
                                    <h5 style="text-align:center;">No Image</h5>
                                <?php endif; ?>
                            </td>

                            <td class="action-buttons" style="text-align:center;">
                                <form method="post" action="" class="button-form" onsubmit="return confirmDelete()">
                                    <input type="hidden" name="edit_product_id" value="<?= $products['product_id'] ?>">
                                    <button type="button" class="button edit-button" onclick="toggleEditFormy('editForm<?= $products['product_id'] ?>')">✎</button>
                                    <input type="hidden" name="delete_product_id" value="<?= $products['product_id'] ?>">
                                    <button type="submit" name="submit_delete" class="button delete-button">✖</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="edit-form" id="editForm<?= $products['product_id'] ?>">
                            <td colspan="6">
                                <form method="post" action="/admin_dashboard/products">
                                    <input type="hidden" name="edit_product_id" value="<?= $products['product_id'] ?>">
                                    <input type="text" name="edited_product" placeholder="Edit Product Name" value="<?= $products['product_name'] ?>" required>
                                    <textarea name="edited_description" rows="2" cols="50" placeholder="Edit Product Description:" required><?= $products['product_description'] ?></textarea>
                                    <input type="number" step="0.01" name="edited_price" placeholder="Edit Price" value="<?= $products['price'] ?>" required>

                                    <!--select option for category-->
                                    <select name="edited_category" id="edited_category" required>
                                        <?php foreach ($categoryProductData as $category) : ?>
                                            <option value="<?= $category['category'] ?>" <?php echo ($products['category'] == $category['category']) ? 'selected' : ''; ?>>
                                                <?php echo $category['category']; ?>
                                            </option>

                                        <?php endforeach; ?>
                                    </select>

                                    <button type="submit" name="submit_edit" class="button edit-button">💾</button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br><br>
    </div>
</div>

<script>
    // ganon din katulad nung sa add button visible lang yung form nung edit pag pinindot naman yung edit na button 
    function toggleEditFormy(formId) {
        var editForm = document.getElementById(formId);
        editForm.style.display = (editForm.style.display === 'none' || editForm.style.display === '') ? 'table-row' : 'none';
    }
    // Insert ingredients

    function toggleIngredientForm(currentProdId) {
        var ingredientsForm = document.getElementById(currentProdId);
        ingredientsForm.style.display = (ingredientsForm.style.display === 'none' || ingredientsForm.style.display === '') ? 'flex' : 'none';
        document.body.style.overflow = 'hidden';
    }

    function closeIngredientForm(currentProdId) {
        var ingredientsForm = document.getElementById(currentProdId);
        ingredientsForm.style.display = 'none';
        document.body.style.overflow = 'visible';
    }

    //view ingredients details of the product
    function toggleIngredientsList(currentProdId) {
        var ingredientsForm = document.getElementById(currentProdId);
        ingredientsForm.style.display = (ingredientsForm.style.display === 'none' || ingredientsForm.style.display === '') ? 'flex' : 'none';
        document.body.style.overflow = 'hidden';
    }

    function closeIngredientsList(currentProdId) {
        var ingredientsForm = document.getElementById(currentProdId);
        ingredientsForm.style.display = 'none';
        document.body.style.overflow = 'visible';
    }


    //add drop down to setting ingredients
    let selectIndex = 1; // Initialize select index counter
    function addDropdown(dropDownProduct) {
        const container = document.getElementById(dropDownProduct);

        // Create a new dropdown
        const dropdownContainer = document.createElement('div');
        dropdownContainer.classList.add('dropdown-container');

        // Create a new select element
        const dropdown = document.createElement('select');
        dropdown.setAttribute('required', '');

        // Set the name for the select element
        dropdown.name = `select${selectIndex}`;

        // Increment select index for the next dropdown
        selectIndex++;

        // Create and add the default option
        const option0 = new Option('select ingredients: ', '');
        option0.setAttribute('selected', '');
        option0.setAttribute('disabled', '');
        dropdown.add(option0);

        // Add options from PHP data (assuming $inventoryData is accessible)
        <?php foreach ($inventoryData as $row) :
            echo "option = new Option('" . $row["inventory_item"] . "', '" . $row["inventory_id"] . "');";
            echo "dropdown.add(option);";
        endforeach; ?>

        // Create a remove button
        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.onclick = function() {
            container.removeChild(dropdownContainer);
        };

        // Append dropdown and remove button to the container
        dropdownContainer.appendChild(dropdown);
        dropdownContainer.appendChild(removeButton);
        container.appendChild(dropdownContainer);
    }



    // toggle add products form

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

    //product category settings

    document.addEventListener('DOMContentLoaded', function() {
        const categoryProduct = document.getElementById('categoryProduct');
        const overlayCategory = document.getElementById('productCategory');
        const closeCategoryFormBtn = document.getElementById('closeProductForm');
        const body = document.body;
        // Initially hide the overlay form
        overlayCategory.style.display = 'none';

        // Show the overlay form when the button is clicked
        categoryProduct.addEventListener('click', function() {
            overlayCategory.style.display = 'flex';
            body.style.overflow = 'hidden';
        });

        // Close the overlay form when the close button is clicked
        closeCategoryFormBtn.addEventListener('click', function() {
            overlayCategory.style.display = 'none';
            body.style.overflow = 'visible';
        });
    });

    //toggle row of edit category
    function toggleEditCategoryForm(categoryId) {
        var categoryForm = document.getElementById(categoryId);
        categoryForm.style.display = (categoryForm.style.display === 'none' || categoryForm.style.display === '') ? 'table-row' : 'none';
    }

    //toggle row of edit category
    function toggleManagePromoForm(promoId) {
        var managePromoForm = document.getElementById(promoId);
        managePromoForm.style.display = (managePromoForm.style.display === 'none' || managePromoForm.style.display === '') ? 'table-row' : 'none';
    }

    //manage promos button
    document.addEventListener('DOMContentLoaded', function() {
        const managePromos = document.getElementById('managePromosBtn');
        const overlayManagePromos = document.getElementById('managePromos');
        const closeManagePromosBtn = document.getElementById('closeManagePromosBtn');
        const body = document.body;
        // Initially hide the update ingredients form
        overlayManagePromos.style.display = 'none';

        // Show the overlay form when the button is clicked
        managePromos.addEventListener('click', function() {
            overlayManagePromos.style.display = 'flex';
            body.style.overflow = 'hidden';
        });

        // Close the overlay form when the close button is clicked
        closeManagePromosBtn.addEventListener('click', function() {
            overlayManagePromos.style.display = 'none';
            body.style.overflow = 'visible';
        });
    });

    //alert delete
    function confirmDelete() {

        var result = confirm("Are you sure you want to delete this product?");
        return result;
    }

    //alert delete
    function confirmDelete() {

        var result = confirm("Are you sure you want to delete this product?");
        return result;
    }


    //alert add
    document.getElementById('addButton').addEventListener('click', function(event) {

        confirm('Are you sure you want to add this product?')
    });


    //alert update
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("deletePromo").addEventListener("click", function() {
            confirm('Are you sure you want to add this promo?')
        });
    });
</script>
</body>

</html>