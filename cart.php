<?php
require_once "settings.php";
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
        foreach (Cart::GetProducts() as $product) {
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="media">
                        <img class="align-self-start mr-3" src="<?= $product->GetData()["icon_url"] ?>" alt="Product icon" width="120px">
                        <div class="media-body">
                            <h5 class="mb-0"><?= $product->GetData()["title"] ?></h5>

                            <div class="clearfix">
                                <div class="float-left">
                                    <p>Price: <span class="text-success font-weight-bold"><?= $product->GetData()["price"] ?> <?= SHOP_CURRENCY ?></span><br></p>
                                </div>
                                <form class="float-right" method="post" action="/api/cart/removeItem.php">
                                    <input type="hidden" name="product_id" value="<?= $product->GetData()["id"] ?>">
                                    <button class="btn btn-sm btn-secondary font-weight-bold" type="submit">X</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <form method="post" action="/api/cart/createOrder.php">
            <button class="btn btn-primary float-right" type="submit">Create order</button>
        </form>

    </div>
    <?php require_once BASE_DIR . "/template/footer.php" ?>
</body>

</html>