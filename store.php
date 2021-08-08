<?php
require_once "settings.php";
require_once BASE_DIR . "/template/navbar.php";
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
        if (Me::IsLoggedIn()) {
        ?>
            <div class="text-right mb-4">
                <a class="btn btn-sm btn-primary" href="/cart.php">Browse my cart</a>
            </div>
        <?php
        }
        ?>

        <div class="row">
            <?php
            foreach (Store::GetProducts() as $product) {
                if ($product->GetData()["quantity"] < 1) {
                    continue;
                }
            ?>
                <div class="col-md-4 mb-3">
                    <a href="/product.php?id=<?= $product->GetData()["id"] ?>">
                        <div class="card product">
                            <div class="card-img" style="background: url('<?= $product->GetData()["icon_url"] ?>') no-repeat center center; background-size: cover"></div>
                            <div class="card-img-overlay">
                                <h5 class="card-title"><?= $product->GetData()["title"] ?></h5>
                                <p class="card-text"><?= $product->GetData()["short_description"] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
    <?php require_once BASE_DIR . "/template/footer.php" ?>
</body>

</html>