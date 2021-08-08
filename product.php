<?php
require_once "settings.php";
require_once BASE_DIR . "/template/navbar.php";

$id = GET("id", true);

try {
    $product = new Product((int) $id);
} catch (Exception $ex) {
    http_response_code(404);
    exit("Error: Product not found");
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

        <div class="media">
            <img class="align-self-start img-thumbnail mr-3" src="<?= $product->GetData()["icon_url"] ?>" width="200px" alt="Product icon">
            <div class="media-body">
                <h5 class="mb-0"><?= $product->GetData()["title"] ?></h5>

                <div class="clearfix">
                    <div class="float-left">
                        <p>
                            Price: <span class="text-success font-weight-bold"><?= $product->GetData()["price"] ?> <?= SHOP_CURRENCY ?></span><br>
                            Quantity: <?= $product->GetData()["quantity"] ?>
                        </p>
                    </div>
                    <div class="float-right">
                        <?php
                        if ($product->GetData()["quantity"] < 1) {
                        } else if (Me::IsLoggedIn()) {
                        ?>
                            <form method="post" action="/api/cart/addItem.php">
                                <input type="hidden" name="product_id" value="<?= $product->GetData()["id"] ?>">
                                <button class="btn btn-primary" type="submit">Add to cart</button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <a class="btn btn-info" href="/auth/login.php">Login</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <p><?= $product->GetData()["description"] ?></p>
            </div>
        </div>

    </div>
    <?php require_once BASE_DIR . "/template/footer.php" ?>
</body>

</html>