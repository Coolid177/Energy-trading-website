<?= $this->section("title") ?>
Sitemap
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<nav class="sitemap-container d-flex" >
    <div class="container d-flex align-items-center">
            <ul class="list-style-none sitemap-url">
                <li class="m-2  sitemap-url">
                    <a href = "http://localhost:8080/home">Home</a>
                </li>
                <li class="m-2">
                    <a href = "http://localhost:8080/profile/profile">Profile</a>
                </li>
                <li class="m-2">
                    <a href = "http://localhost:8080/profile/notifications">Notifications</a>
                </li>
                <li class="m-2">
                    <a href = "http://localhost:8080/profile/orders">Orders</a>
                </li>
                <?php if(session()->isVendor == true): ?>
                    <li class="m-2">
                        <a href = "http://localhost:8080/profile/myproducts">My products</a>
                    </li>
                    <li class="m-2">
                        <a href = "http://localhost:8080/profile/create_product">Create product</a>
                    </li>
                    <li class="m-2">
                        <a href = "http://localhost:8080/profile/statistics">Statistics</a>
                    </li>
                <?php endif ?>
                <li class="m-2">
                    <a href = "http://localhost:8080/shoppingcart">Shopping cart</a>
                </li>
                <li class="m-2">
                    <a href = "http://localhost:8080/messages">Messages</a>
                </li>
                <li class="m-2">
                    <a href = "http://localhost:8080/products">Products</a>
                </li>
                <li class="m-2">
                    <a href = "http://localhost:8080/logout">Logout</a>
                </li>
                <li class="m-2">
                    <a>Search products</a>
                </li>
                <li>
                    <!-- searchbar start -->
                    <form class="d-flex" role="search" action="/product/search" method="post">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" >
                        <button type = "submit" class = "material-icons">search</button>
                    </form>
                    <!-- end searchbar -->
                </li>
            </ul>
    </div>
</nav>
<?= $this->endsection() ?>
