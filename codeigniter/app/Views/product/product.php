<?= $this->section("title") ?>
product
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<div class="container-sm">
    <!-- start carousel -->
    <div id="carouselExampleControls" class="carousel slide">
        <div class="carousel-inner d-flex align-items-center mt-4 carousel-product-heigt">
            <?php $activebool = true ?>
            <?php foreach($images as $image): ?>
                <?php if($activebool): ?>
                    <div class="carousel-item active">
                <?php $activebool = false ?>
                <?php else: ?>
                    <div class="carousel-item"> 
                <?php endif ?>
                <?php if(!(substr($image, strlen($image)-3) == "mp4" || substr($image, strlen($image)-3) == "mkv")): ?>
                    <img src="<?= base_url('/Product_uploads/'.$image) ?>" class="d-block carousel-image w-100">
                <?php else: ?>
                    <button class="active play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill no-pointer-events" viewBox="0 0 16 16">
                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                        </svg>
                    </button>
                    <video width="320" height="240" class="carousel-image d-block w-100 overflow-hidden">
                        <source src="<?= base_url('/Product_uploads/'.$image) ?>" type="video/mp4">
                        <source src="<?= base_url('/Product_uploads/'.$image) ?>" type="video/mkv">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
                </div> 
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" aria-label="go to previous image" >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" aria-label="go to next image">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end carousel -->
    <?php if($product[0]->IsActive == 0): ?>
    <div class="alert alert-danger mt-4 sold-out">
        <span>
            This product is no longer available
        </span>
    </div>
    <?php endif ?>
    <div class="d-flex flex-row mb-4">
        <div class = "d-flex flex-column properties full-width">
            <a class="titel"><?= $product[0]->Title ?></a>
            <a class="property">Price: <?= $product[0]->Price."€" ?></a>
            <a class="property">soort energie: <?= $product[0]->ProductType ?></a>
            <?php if($product[0]->IsActive == 1) :?>
                <?php if($product[0]->Quantity != 0): ?>
                    <a id="quantity" class="property">beschikbaarheid: Nog <?= $product[0]->Quantity ?> items beschikbaar</a>
                <?php else: ?>
                    <a class="property">beschikbaarheid: Uitverkocht</a>
                <?php endif; ?>
            <?php endif; ?>
            <a class="property">land van herkomst: <?= $product[0]->Origin ?></a>
            <a class="property" href = "<?= "/profile/".$product[0]->VendorId ?>">Verkoop door: <?= " ".$product[0]->VendorFname." ".$product[0]->VendorLname ?> </a>
            <a><?= $product[0]->Description ?></a>
            <?php if($product[0]->Quantity == 0): ?>
            <div class="alert alert-info d-flex" role="alert">
                <div class="align-self-center">
                    This product is sold out. 
                </div>
                <form action="addNotification" class="justify-content-end" method="post"> 
                    <input type="hidden" name= "productId" value="<?= $product[0]->ProductId ?>"/>
                    <button class = "btn btn-info" aria-label="select to receive or dereceive a notification">
                        <?php if($notification == null): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                            </svg>
                        <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                            </svg>
                        <?php endif; ?>
                    </button>
                </form> 
            </div>
            <?php elseif($product[0]->IsActive == 1): ?>
            <form action="<?= base_url('ShoppingCart/AddProductToCart') ?>" method ="post">
                <div class="input-group mb-3">
                    <button class="btn btn-success" type="submit" aria-label="add the quantity to the shoppingcart">Add to cart</button>
                    <input type="hidden" name= "productId" value="<?= $product[0]->ProductId ?>"/>
                </div>
            </form>
            <?php if (!empty(session()->getFlashData('fail'))): ?>
                <span class="alert alert-info"><?= session()->getFlashData('fail') ?></span>
            <?php endif ?>
            <?php endif ?>
        </div>
    </div>
 
    <?php if(!empty($canUserLeaveReview[0]->canUserLeaveReview) && $canUserLeaveReview[0]): ?>
    <div class="d-flex flex-column justify-content-center mb-4">
        <div class="rounded-4 rounded bg-light border-light border-2 review-wrapper">
            <form name="store_review" method="post" action="/saveReview/<?= $product[0]->ProductId ?>" id="postReview">
                <div class="mb-3">
                    <div class="col">
                        <svg onclick="setValue(this.id)" id="1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="star-select bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg onclick="setValue(this.id)" id="2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="star-select bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg onclick="setValue(this.id)" id="3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="star-select bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg onclick="setValue(this.id)" id="4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="star-select bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg onclick="setValue(this.id)" id="5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="star-select bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <input id="starsInput" type="hidden" name= "Stars" value="0">
                        <span id="stars-error">
                        <?php if(!empty(session()->getFlashData('Stars'))): ?>
                            <?= session()->getFlashData('Stars') ?>
                        <?php endif; ?>
                    </span>
                    </div>
                    <label for="Title" class="form-label">Titel</label>
                    <input class="form-control" name= "Title" id="titleInput">
                    <span id="title-error">
                        <?php if(!empty(session()->getFlashData('Title'))): ?>
                            <?= session()->getFlashData('Title') ?>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="Description"class="form-label">Description</label>
                    <textarea name="Description" class="form-control" aria-label="With textarea"  id="descriptionInput"></textarea>
                    <span id="description-error">
                        <?php if(!empty(session()->getFlashData('Description'))): ?>
                            <?= session()->getFlashData('Description') ?>
                        <?php endif; ?>
                    </span>
                </div>
                <button type="submit" class="btn btn-success" aria-label="save the review">Post</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($userReview)): ?> 
    <div class="d-flex flex-column justify-content-center mb-4">
        <div class="rounded-4 rounded bg-light border-light border-2 review-wrapper">
            <form action="/updateReview/<?= $product[0]->ProductId ?>" method = "POST" id="postReview">
                <div class="column">
                    <?php for($i = 0; $i < $userReview[0]->Rating; $i++): ?>
                        <svg onclick="setValue(this.id)" id="<?=$i + 1?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="color-yellow star-select bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    <?php endfor; ?>
                    <?php for($i = $userReview[0]->Rating; $i < 5; $i++): ?>
                        <svg onclick="setValue(this.id)" id="<?=$i + 2 ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="star-select bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    <?php endfor; ?>
                    <input id="starsInput" type="hidden" name= "Stars" value="<?=$userReview[0]->Rating?>">
                    <span id="rating-error">
                        <?php if(!empty(session()->getFlashData('Stars'))): ?>
                            <?= session()->getFlashData('Stars') ?>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="d-flex flex-column">
                    <span for="Title" aria-label="edit the title of the review"></span>
                    <input class = "form-control review-titel" name="Title"  id="titleInput" value="<?= $userReview[0]->Title ?>"/>
                    <span id="title-error">
                        <?php if(!empty(session()->getFlashData('Title'))): ?>
                            <?= session()->getFlashData('Title') ?>
                        <?php endif; ?>
                    </span>
                </div>
                <span for="Description" aria-label="edit the description of the review"></span>
                <textarea class = "form-control review-description" name="Description"  id="descriptionInput"><?= $userReview[0]->Description ?></textarea>
                <span id="description-error">
                    <?php if(!empty(session()->getFlashData('Description'))): ?>
                        <?= session()->getFlashData('Description') ?>
                    <?php endif; ?>
                </span>
                <div class="d-flex flex-row post-properties">
                    <a><?= $userReview[0]->Fname." ".$userReview[0]->Lname." | ".$userReview[0]->Date ?></a>
                </div>
                <button type="submit" class="btn btn-success">Update review</button>
            </form>
        </div>
    </div>
    <?php endif ?>

    <?php foreach($reviews as $review): ?>
    <div class="d-flex flex-column justify-content-center mb-4">
        <div class="rounded-4 rounded bg-light border-light border-2 review-wrapper">
            <div class="column">
                <?php for($i = 0; $i < $review->Rating; $i++): ?>
                <svg class="color-yellow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
                <?php endfor; ?>
                <?php for($i = $review->Rating; $i < 5; $i++): ?>
                <svg class="color-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
                <?php endfor; ?>
            </div>
            <div class="d-flex flex-column">
                <a class = "review-titel"><?= $review->Title ?></a>
            </div>
            <a class = "review-description"><?= $review->Description ?></a>
            <div class="d-flex flex-row post-properties">
                <a><?= $review->Fname." ".$review->Lname." | ".$review->Date ?></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>    
</div>
<?= $this->endsection() ?>
<?= $this->section("javascript") ?>
<script src="/product.js"></script>
<?= $this->endsection() ?>