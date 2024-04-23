<?php require 'partials/head.php'; ?>
<?php require 'partials/nav.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5"
            style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">NAME OF THE COFFEE EXAMPLE</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">NAME OF THE COFFEE EXAMPLE</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Menu Start -->
    <!-- Product Image and Details Section -->
    <div class="container product-section mt-5">
        <div class="row align-items-center">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="uploads/<?= $product['image'] ?>" alt="Product Image" class="img-fluid">
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h2><?= $product['product_name'] ?></h2>
                <p><?= $product['product_description'] ?></p>
                <p><strong>Price: $<?= $product['price'] ?></strong></p>

                <form action="/menu" method="POST">
                    <input type="hidden" name="order_type" value="take-out">
                    <input type="hidden" name="base_coffee_id" value="<?= $product['product_id'] ?>">
                    <input type="hidden" name="base_coffee" value="<?= $product['product_name'] ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
            <!-- Product Details -->
        </div>
    </div>
    </br>
    </br>
    </br>


    <div class="container product-suggestions mt-5">
        <h2 class="text-center">You May Also Like</h2>
        <br>
        <br>
        <div class="row">
            <script>
                // Fetch product data from the backend
                fetch('/get_product')
                    .then(response => response.json())
                    .then(products => {
                        const productContainer = document.getElementById('product-list');

                        // Loop through the products and display them
                        products.forEach(product => {
                            const productCard = document.createElement('div');
                            productCard.className = 'col-lg-4 col-md-6 mb-5';
                            productCard.innerHTML = `
                                                <h4><a href ="#">${product.product_name}</a></h4>
                                                <p>${product.product_description}</p>
                                                <h5 class="menu-price">${product.price}</h5>
                                            `;
                            productContainer.appendChild(productCard);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            </script>
        </div>
    </div>

    <!-- Menu End -->





    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

<?php require 'partials/foot.php'; ?>