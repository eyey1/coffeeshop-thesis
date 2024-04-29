<?php require "partials/head.php"; ?>
<?php require "partials/nav.php"; ?>

<div class="sellables-container">
  <div class="sellables">
    <?php require "partials/nav2.php"; ?>

    <div class="item-group-wrapper">
      <div class="item-group" id="item-data">
        <table>
          <thead>
            <tr>
              <th>Order Number</th>
              <th>Customer Full Name</th>
              <th>User Name</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($online_orders as $order) : ?>
              <tr>
                <td><?= $order['order_number']; ?></td>
                <td><?= $order['firstname'] . " " . $order['lastname']; ?></td>
                <td><?= $order['username']; ?></td>
                <td><?= $order['product_name']; ?></td>
                <td><?= $order['price']; ?></p>
                <td><?= $order['quantity']; ?></td>
                <td>
                  <button>View</button>
                  <button>Decline</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="register-wrapper">
    <div class="customer">
      <input type="text" placeholder="John Doe" />
    </div>

    <div class="register">
      <div class="products">
        <div class="product-bar selected">
          <span>Salted Caramel</span>
          <span>$5.00</span>
        </div>

        <div class="product-bar">
          <span>Dark Caramel</span>
          <span>$5.00</span>
        </div>

        <div class="product-bar">
          <span>Cookies</span>
          <span>$5.00</span>
        </div>
      </div>

      <div class="pay-button">
        <a href="#">Pay $50.00</a>
      </div>
    </div>
  </div>
</div>
<?php require "partials/foot.php"; ?>

<!-- Template Javascript -->
<?php require "js/main.php"; ?>

<!-- Contact Javascript File -->
<script src="mail/contact.js"></script>