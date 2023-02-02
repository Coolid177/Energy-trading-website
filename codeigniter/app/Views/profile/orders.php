<?= $this->section("title") ?>
orders
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<?= $this->include("templates/profilenavigation") ?>
<div class="container">
    <div class = "d-flex justify-content-center">
        <h1>Orders</h1>
    </div>
    <?php if (count($AddressData) == 0): ?>
    <div class="alert alert-info mt-4" role="alert">
        Your have not yet made any orders
    </div>
    <?php endif ?>
    <?php for($i = count($AddressData)-1; $i >= 0; $i--): ?>
        <div class = "mb-4">
            <div class="row">
                <div class="col-sm"></div>
                <div class="col-sm">Product name</div>
                <div class="col-sm">Product type</div>
                <div class="col-sm">Quantity</div>
                <div class="col-sm">Product total price</div>
            </div>
            <?php foreach($ProductData[$i] as $Product): ?>
            <!-- product details here --> 
            <div class="clickable border mt-2 row small-border">
                <a href="/product/<?= $Product->ProductId ?>">
                    <span class="link"></span>
                </a> 
                <div class="gallery col-sm mt-2 mb-2">
                    <img src="<?= "/Product_uploads/".$Product->Media_name ?>" class="shoppingcart-image">
                </div> 
                <div class="col-sm align-self-center d-flex">
                    <?= $Product->Title ?>
                </div>
                <div class="col-sm align-self-center d-flex">
                    <?= $Product->ProductType ?>
                </div>
                <div class="col-sm align-self-center d-flex">
                    <?= $Product->Quantity ?>
                </div>
                <div class="col-sm align-self-center d-flex">
                    <?= $Product->Quantity*$Product->Price_per_item ?>
                </div>
            </div>
            <?php endforeach ?>
            <!-- address and delivery option here -->
            <div class="row">
                <div class="row mt-1">
                    <?php if($AddressData[$i]->Delivery_choice == "Delivery"): ?>
                        <div class = "col-sm">
                            <a> Delivery address: </a>
                            <div>
                                <?= $AddressData[$i]->Street ?>
                                <?= $AddressData[$i]->Number ?>
                            </div>
                            <div>
                                <?= $AddressData[$i]->Postal_code ?>
                                <?= $AddressData[$i]->City ?>
                            </div>
                            <div>
                                <?= $AddressData[$i]->Country ?>
                            </div>
                        </div>
                        <div class="col-sm">
                            <a><?= "Will be delivered on: ".$AddressData[$i]->DeliveryDate." in the ".$AddressData[$i]->DeliveryTime ?></a>
                        </div>
                    <?php else: ?>
                        <div class = "col-sm">
                            <a> Products can be collected at: </a>
                            <div>
                                Kolejowa 
                                18 
                            </div>
                            <div>
                                41-902 Bytom
                            </div>
                            <div>
                                Polen
                            </div>
                        </div>    
                        <div class="col-sm">
                            <a><?= "Order can be collected on: ".$AddressData[$i]->DeliveryDate." in the ".$AddressData[$i]->DeliveryTime ?></a>
                        </div>                
                    <?php endif ?>
                    <div class="col-sm">
                        <a><?= "Ordered on: ".$AddressData[$i]->orderedOn?></a>
                    </div>
                    <?php if(strtotime(date('y-m-d')) < strtotime($AddressData[$i]->DeliveryDate)): ?>
                        <?php if(strtotime(date('y-m-d').'+ 1 days') <= strtotime($AddressData[$i]->DeliveryDate)): ?>
                            <div class="col-sm d-flex align-self-end justify-content-end">
                                <form name= "cancel_order" action="/shoppingcart/cancel_order" method="POST" enctype="multipart/form-data">
                                    <input  value="<?= $AddressData[$i]->OrderId ?>" type="hidden" name="orderId"/>
                                    <button class="border-none color-red"type="submit" aria-label="cancel the made order">
                                        Cancel order
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endfor ?>
</div>  
<?= $this->endsection() ?>