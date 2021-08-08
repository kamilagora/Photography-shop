<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

    <a class="navbar-brand" href="/index.php">Photography store</a>

    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="/index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/store.php">Store</a>
            </li>

            <?php
            if (Me::IsLoggedIn()) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="/user/orders.php">Orders</a>
                </li>
            <?php
            } else {
            ?>
            <?php
            }
            ?>


        </ul>
        <ul class="navbar-nav ml-auto">

            <?php
            if (Me::IsLoggedIn()) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="/user/settings.php">Settings</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/user/logout.php">Logout</a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/login.php">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/auth/register.php">Register</a>
                </li>
            <?php
            }
            ?>


        </ul>
    </div>

</nav>