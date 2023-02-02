<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="<?= base_url('/CSS/Login.css') ?>" rel="stylesheet">
        <link href="<?= base_url('/CSS/Main.css') ?>" rel="stylesheet">
        <link rel="shortcut icon" href="Public_images/page_icon.ico">
        <title><?= $this->rendersection("title") ?></title>
    </head>
    <?= $this->rendersection("symbols") ?>
    <body class="d-flex flex-column">
        <!-- navbar start-->
        <nav class="navbar navbar-expand-lg bg-lg-green">
            <div class="container-fluid">
                <nav class="navbar bg-green">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/home">Energetic</a>
                    </div>
                </nav>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button> 
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/profile/profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/shoppingcart">Shopping cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/messages">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/products">Products</a>
                        </li>
                        <?php 
                            if (session()->get('LoggedIn')){
                            echo '<li class="nav-item">';
                              echo '<a class="nav-link active" aria-current="page" href="/logout">Logout</a>';
                            echo '</li>';
                            }
                            ?>
                    </ul>
                    <!-- searchbar start -->
                    <form class="d-flex" role="search" action="/product/search" method="post">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button type = "submit" class = "material-icons">search</button>
                    </form>
                    <!-- end searchbar -->
                </div>
            </div>
        </nav>
        <!-- end navbar -->
        <?= $this->rendersection("content") ?>
        <footer class="footer mt-auto">
            <div class = "bg-lg-green">
                <div class="container">
                    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-4 pyt-3">
                        <!-- start columns -->
                        <div class="col mb-3 text-center">
                            <h5>Hout</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?wood=1&pellets=1&max+price=" class="nav-link p-0 text-muted">Pellets</a></li>
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?wood=1&briketten=1&max+price=" class="nav-link p-0 text-muted">Briketten</a></li>
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?wood=1&brandhout=1&max+price=" class="nav-link p-0 text-muted">Brandhout</a></li>
                            </ul>
                        </div>
                        <div class="col mb-3 text-center">
                            <h5>Gas</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?gas=1&aardgas=1&max+price=" class="nav-link p-0 text-muted">Aardgas</a></li>
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?gas=1&biogas=1&max+price=" class="nav-link p-0 text-muted">Biogas</a></li>
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?gas=1&butaan=1&max+price=" class="nav-link p-0 text-muted">Butaan</a></li>
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?gas=1&propaan=1&max+price=" class="nav-link p-0 text-muted">Propaan</a></li>
                            </ul>
                        </div>
                        <div class="col mb-3 text-center">
                            <h5>Olie</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?oil=1&aardolie=1&max+price=" class="nav-link p-0 text-muted">Aardolie</a></li>
                                <li class="nav-item mb-2"><a href="http://localhost:8080/FilterProducts?oil=1&Synthetische+olie=1&max+price=" class="nav-link p-0 text-muted">Synthetische olie</a></li>
                            </ul>
                        </div>
                        <div class="col mb-3 text-center">
                            <h5>Find us on</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="https://www.facebook.com/profile.php?id=100088772531166&is_tour_dismissed=true" class="nav-link p-0 text-muted">Facebook</a></li>
                            </ul>
                        </div>
                        <!-- end columns -->
                    </footer>
                    <!-- start services -->
                    <footer>
                        <ul class="nav justify-content-center border-top">
                            <li class="nav-item"><a href="/sitemap" class="nav-link px-2 text-muted">Sitemap</a></li>
                            <li class="nav-item"><a href="/accessibility" class="nav-link px-2 text-muted">accessibility</a></li>
                            <li class="nav-item"><a href="/Terms_of_use.pdf" target="_blank" class="nav-link px-2 text-muted">Algemene voorwaarden</a></li>
                            <li class="nav-item"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="nav-link px-2 text-muted">About</a></li>
                        </ul>
                        <p class="text-center text-muted mb-0 pb-3">&copy; 2022 Energetic</p>
                    </footer>
                    <!-- end services -->
                </div>
            </div>
        </footer>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?= $this->rendersection("javascript") ?>
</html>