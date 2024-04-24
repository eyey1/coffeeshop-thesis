<?php require "partials/head.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #F5F5DC;
    }

    table {
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        color: #333;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #2473c0;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
</head>

<body>
    <div class="dashboard">
        <div class="sidebar">
            <h1>Coffee Shop</h1>
            <?php if ($_SESSION['position'] == "barista") : ?>
                <ul>
                    <li><a href="Orders.php">Orders</a></li>
                </ul>
            <?php else : ?>
                <?php require "partials/nav.php"; ?>
            <?php endif; ?>
        </div>

        <!--ORDERS TAB-->
        <div class="content">
            <h2>Orders
                <?php echo " (" . $_SESSION['user']['email'] . " the " . $_SESSION['user']['position'] . ") " ?>
            </h2>
            <div><!--SHOW ORDERS THAT ARE ACTIVE-->
                <form method="post" action="/admin_dashboard/orders">
                    <table class="table table-bordered" id="ordersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="6" style="background-color: #222e5d;">
                                    <h3>Active Orders</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Order Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // Database connection
                            $servername = "localhost";
                            $user = "root";
                            $pass = "";
                            $dbname = "coffeeshop_db";


                            // Create a database connection
                            $conn = new mysqli($servername, $user, $pass, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            //for pdo
                            try {
                                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            } catch (PDOException $e) {
                                die("Database connection failed: " . $e->getMessage());
                            }

                            $sql_ordersActive = "SELECT
                            oi.orderitem_id,
                            c.customername,
                            p.product_name,
                            oi.quantity AS total_quantity,
                            o.order_type,
                            oi.status AS order_status
                        FROM
                            tblorderitem oi
                        JOIN
                            tblorders o ON oi.orderid = o.order_id
                        JOIN
                            tblproducts p ON oi.productid = p.product_id
                        JOIN
                            tblcustomers c ON o.customer_id = c.customerid
                        WHERE
                            oi.status = 'active'
                        GROUP BY
                            c.customerid, c.customername, p.product_name, o.order_type, oi.status";

                            $result_ordersActive = $conn->query($sql_ordersActive);
                            while ($row = $result_ordersActive->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <?php echo $row['customername']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['product_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['total_quantity']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_status']; ?>
                                    </td>
                                    <td>
                                        <button type="submit" name="finish_order" value="<?php echo $row['orderitem_id']; ?>">Finish</button>
                                        <button type="submit" name="ended_order" value="<?php echo $row['orderitem_id']; ?>">End</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <!--SHOW ORDERS THAT ARE COMPLETED-->
            <div>
                <form method="post" action="/admin_dashboard/orders">
                    <table class="table table-bordered" id="ordersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="5" style="background-color: #008000;">
                                    <h3>Completed Orders</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Order Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_ordersComplete = "SELECT
                            oi.orderitem_id,
                            c.customername,
                            p.product_name,
                            oi.quantity AS total_quantity,
                            o.order_type,
                            oi.status AS order_status
                        FROM
                            tblorderitem oi
                        JOIN
                            tblorders o ON oi.orderid = o.order_id
                        JOIN
                            tblproducts p ON oi.productid = p.product_id
                        JOIN
                            tblcustomers c ON o.customer_id = c.customerid
                        WHERE
                            oi.status = 'completed'
                        GROUP BY
                            c.customerid, c.customername, p.product_name, o.order_type, oi.status
                            ";
                            $result_ordersComplete = $conn->query($sql_ordersComplete);
                            while ($row = $result_ordersComplete->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <?php echo $row['customername']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['product_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['total_quantity']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_status']; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <!--SHOW ORDERS THAT ARE ENDED-->
            <div>
                <form method="post" action="/admin_dashboard/orders">
                    <table class="table table-bordered" id="ordersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="6" style="background-color: #800000;">
                                    <h3>Archived Orders</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Order Type</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_ordersEnded = "SELECT
                            oi.orderitem_id,
                            c.customername,
                            p.product_name,
                            oi.quantity AS total_quantity,
                            o.order_type,
                            oi.status AS order_status
                        FROM
                            tblorderitem oi
                        JOIN
                            tblorders o ON oi.orderid = o.order_id
                        JOIN
                            tblproducts p ON oi.productid = p.product_id
                        JOIN
                            tblcustomers c ON o.customer_id = c.customerid
                        WHERE
                            oi.status = 'ended'
                        GROUP BY
                            c.customerid, c.customername, p.product_name, o.order_type, oi.status
                            ";
                            $result_ordersEnded = $conn->query($sql_ordersEnded);
                            while ($row = $result_ordersEnded->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <?php echo $row['customername']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['product_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['total_quantity']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_status']; ?>
                                    </td>
                                    <td>
                                        <button type="submit" name="unarchive_order" value="<?php echo $row['orderitem_id']; ?>">Un-archive</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <br><br>
        </div>

    </div>
</body>

</html>