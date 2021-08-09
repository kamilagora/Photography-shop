<?php
require_once "../settings.php";
require_once BASE_DIR . "/template/navbar.php";

if (!Me::IsLoggedIn()) {
    http_response_code(403);
    exit("Error: User not logged in");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_DIR . "/template/header.php" ?>
</head>

<body>
    <div style="height: 100px"></div>
    <div class="container">

        <?php
        foreach (Order::GetOrders(Me::GetUser()->GetData()["id"]) as $row) {
            $product_ids = json_decode($row["json_data"], true);
        ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="mb-0">Order <span class="text-monospace">#<?= $row["id"] ?></span></h3>
                </div>
                <div class="card-body">
                    <?php
                    if ($row["is_shipped"] === 1) {
                        echo '<p>Status: <span class="text-success"><b>SHIPPED</b></span></p>';
                    } else if ($row["is_paid"] === 1) {
                        echo '<p>Status: <span class="text-success"><b>PAID</b></span></p>';
                    } else {
                        echo '<p>Status: <span class="text-danger"><b>UNPAID</b></span></p>';
                    }
                    ?>
                    <ol>
                        <?php
                        foreach ($product_ids as $product_id) {
                            $product = new Product($product_id);
                            $p_row = $product->GetData();

                            echo '<li><a href="/product.php?id=' . $product_id . '" target="_blank">' . $p_row["title"] . '</a></li>';
                        }
                        ?>
                    </ol>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
    <?php require_once BASE_DIR . "/template/footer.php" ?>
</body>

</html>