<?= $this->extend("templates/base") ?>
<?= $this->section("title") ?>
shoppingcart
<?= $this->endsection() ?>
<?= $this->section("content") ?>
<div class="container mt-4 mb-4 pb-1">
    <?php if(!empty(session()->getFlashData('errors'))): ?>
        <div class="alert alert-danger">
            The following items are no longer available in the quantity that you desire
            <p>
            <?php foreach(session()->getFlashData('errors') as $error): ?>
            <div>
                <a><?= "Product: ".$error['ProductName'] ?></a>
                <a><?= "Quantity in stock: ".$error['Quantity'] ?></a>
            </div> 
            <?php endforeach ?>
            </p>
        </div>
    <?php endif; ?>
    <?php if(!empty(session()->getFlashData('noLongerAvailable'))): ?>
        <div class="alert alert-danger">
            The following items are removed by the owner and have been removed from your cart. No money was taken from your bank account.
            <p>
                <ul>
                <?php foreach(session()->getFlashData('noLongerAvailable') as $error): ?>
                    <li><?= "Product: ".$error['ProductName'] ?></li>
                <?php endforeach ?>
                </ul>
            </p>
        </div>
    <?php endif; ?>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" aria-label="toggle the first accordion element">
                    Shopping cart
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php if (count($items) == 0): ?>
                    <div class="alert alert-info" role="alert">
                        Your cart is empty
                    </div>
                    <?php endif; ?>
                    <?php if (count($items) != 0): ?>
                    <div class="row">
                        <div class="col-5 col-xs">Product</div>
                        <div class="col-2 col-xs text-align-center">Individual price</div>
                        <div class="col-2 col-xs text-align-center">Quantity</div>
                        <div class="col-2 col-xs text-align-center">Product total price</div>
                        <div class="col-1 col-xs text-align-center"></div>
                    </div>
                    <?php for($i = 0; $i < count($items); $i++): ?>
                    <div class="shoppingcart-border">
                        <div class="row mt-1 mb-1">
                            <div class="col-xs col-5">
                                <div class="row">
                                    <div class="col-md-auto gallery">
                                        <img src="<?= "/Product_uploads/".$items[$i]->Media_name ?>" class="shoppingcart-image">
                                    </div>
                                    <div class="col">
                                        <div class="shoppingcart-titel">
                                            <?= $items[$i]->Title ?>
                                        </div>
                                        <div>
                                            <?= $items[$i]->ProductType ?>
                                        </div>
                                        <div>
                                            <?= $items[$i]->Origin ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-xs align-self-center d-flex justify-content-center price">
                                <?= $items[$i]->Price."€" ?>
                            </div>
                            <div class="col-2 col-xs  align-self-center d-flex justify-content-center">
                                <label for="quantity" class="form-label" aria-label="change the quantity you want to order"></label>
                                <input class="form-control quantity" min = "0" type = "number" name="quantity" value="<?= session('ShoppingCart')[$i]['Quantity'] ?>"/>
                            </div>
                            <div class="col-2 col-xs  align-self-center d-flex justify-content-center totalProductPrice">
                            </div>
                            <div class="col-1 cos-xs align-self-center d-flex justyfy-content-center">
                                <form name= "remove product" action="/shoppingcart/remove_product_from_cart" method="POST" enctype="multipart/form-data">
                                    <input  value="<?= $items[$i]->ProductId ?>" type="hidden" name="productId"/>
                                    <button class="border-none" type="submit" aira-label="remove product from shoppingcart">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endfor ?>
                    <div class = "mb-2 shoppingcart-border">
                    </div>
                    <div class="d-flex justify-content-end" id="totalPrice">
                         
                    </div>
                    <div class="d-flex justify-content-end">
                        <button onclick = "displayAddressLine()" class="btn btn-success" type="button" aria-label="toggle address accordion item" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">Continue</button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if (count($items) != 0): ?>
            <form action="shoppingcart/place_order" method="POST" id="placeOrder">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button aria-label="toggle address accordion item"class="accordion-button collapsed" id="Address" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Address
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <label for="deliver_option" class="form-label">Choose the type of delivery</label>
                            <div class="form-group mb-3" id="selectDeliveryOption">
                                <select name = "deliver_option" class="form-select" id="deliveryOption">
                                <option value="Delivery">Delivery</option>
                                <option value="Collect">Collect and Go</option>
                                </select>
                                <span  id="deliver_option-error">
                                    <?php if(!empty(session()->getFlashData('deliver_option'))): ?>
                                        <?= session()->getFlashData('deliver_option') ?>
                                    <?php endif ?>
                                </span>
                            </div>
                            <div id="deliveryOptionHide">
                                <div class="mb-3">
                                    <label for="street"class="form-label">Street</label>
                                    <input class="form-control" name="street" id="streetInput">
                                    <span  id="street-error">
                                        <?php if(!empty(session()->getFlashData('street'))): ?>
                                            <?= session()->getFlashData('street') ?>
                                        <?php endif ?>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">Number</label>
                                    <input class="form-control" name="number" id="numberInput">
                                    <span  id="number-error">
                                        <?php if(!empty(session()->getFlashData('number'))): ?>
                                            <?= session()->getFlashData('number') ?>
                                        <?php endif ?> 
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="city"class="form-label">City</label>
                                    <input class="form-control" name="city" id="cityInput">
                                    <span  id="city-error">
                                        <?php if(!empty(session()->getFlashData('city'))): ?>
                                            <?= session()->getFlashData('city') ?>
                                        <?php endif ?>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="postal code" class="form-label">Postal Code</label>
                                    <input class="form-control" name="postal code" id="postCodeInput">
                                    <span  id="postal_code-error">
                                        <?php if(!empty(session()->getFlashData('postal_code'))): ?>
                                            <?= session()->getFlashData('postal_code') ?>
                                        <?php endif ?>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input class="form-control" name="country" id="countryInput">
                                    <span  id="country-error">
                                        <?php if(!empty(session()->getFlashData('country'))): ?>
                                            <?= session()->getFlashData('country') ?>
                                        <?php endif ?>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_delivery" class="form-label">Date of delivery</label>
                                <input class="form-control" type="date" name="date_of_delivery" min="<?php $date=date('Y-m-d'); echo date('Y-m-d', strtoTime($date.'+ 4 days')) ?>" max="<?= date('Y-m-d', strtoTime($date.'+ 100 days')) ?>" id="deliveryDateInput">
                                <span  id="date_of_delivery-error">
                                    <?php if(!empty(session()->getFlashData('date_of_delivery'))): ?>
                                        <?= session()->getFlashData('date_of_delivery') ?>
                                    <?php endif ?>
                                </span>
                            </div>
                            <div class="form-group mb-3" id="selectDeliveryOption">
                                <label for="delivery_time" class="form-label">Time of delivery</label>
                                <select name = "delivery_time" class="form-select" id="timeDeliveryOption">
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                </select>
                                <span id="delivery_time-error">
                                    <?php if(!empty(session()->getFlashData('delivery_time'))): ?>
                                        <?= session()->getFlashData('delivery_time') ?>
                                    <?php endif ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button onclick = "displayPaymentLine()" class="btn btn-success" type="button" aria-label="toggle payment accordion item">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item"> 
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" aria-label="toggle payment accordion item"id= "Payment" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Payment
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="card number" class="form-label">Mastercard</label>
                                <input class="form-control" name="card number">
                                <span>
                                    <?php if(!empty(session()->getFlashData('card_number'))): ?>
                                        <?= session()->getFlashData('card_number') ?>
                                    <?php endif ?>
                                </span>
                            </div>
                            <div class="mb-3">
                                <label for="expiration date" class="form-label">Expiration date</label>
                                <input class="form-control" name="expiration date">
                                <?php if(!empty(session()->getFlashData('expiration_date'))): ?>
                                    <?= session()->getFlashData('expiration_date') ?>
                                <?php endif ?>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success" type="submit" aria-label="place order">Place order</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        <?php endif ?>
    </div>
</div>
<?= $this->endsection() ?>
<?= $this->section("javascript") ?>
<script src="/shoppingcart.js"></script>
<?= $this->endsection() ?>