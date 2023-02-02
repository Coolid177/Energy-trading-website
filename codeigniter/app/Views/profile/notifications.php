<?= $this->section("title") ?>
notifications
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<?= $this->include("templates/profilenavigation") ?>
<div class="container">
    <div class = "d-flex justify-content-center">
        <h1>Notifications</h1>
    </div>
    <?php if (empty($notifications)): ?>
        <div class="alert alert-info mt-4" role="alert">
            You don't have any Notifications
        </div>
    <?php endif; ?>
    <div class="row">
        <?php for($i = count($notifications)-1; $i >= 0; $i--): ?>
        <div class="col-11 d-flex align-items-center">
            <div class=" p-2 mb-2 notification w-100">
                <div class="time"><?= $notifications[$i]->Time ?></div>
                <?php if ($notifications[$i]->TypeOfNotification == 'Product'): ?>
                    <div class="message"><?= $notifications[$i]->Title." is back in stock!" ?></div>
                <?php else: ?>
                    <div class="message"><?= "Please leave a review for this product: ".$notifications[$i]->Title ?></div>
                <?php endif ?>
                <a href="<?= base_url("/product/".$notifications[$i]->ProductId) ?>" class="hyperlink" aria-label="click this to go to the product">Go to product</a>
            </div>
        </div>
        <div class="col-1">
            <img src="<?= "/Product_uploads/".$notifications[$i]->Media_name ?>" class="notification-image">
        </div>
        <?php endfor; ?>
    </div>
</div> 
<?= $this->endsection() ?>