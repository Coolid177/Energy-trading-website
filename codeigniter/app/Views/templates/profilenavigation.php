<div class="container main-container">
    <div class="flex-end" style="margin-left: auto;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/profile/profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile/notifications">Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile/orders">Orders</a>
            </li>
            <?php
            if (session()->get('isVendor')){
            echo '<li class="nav-item">
                <a class="nav-link" href="/profile/myproducts">My Products</a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link" href="/profile/create_product">Create product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile/statistics">Statistics</a>
            </li>';}
            ?>
        </ul>
    </div>
</div>