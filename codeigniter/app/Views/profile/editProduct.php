<?= $this->section("title") ?>
edit product
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<?= $this->include("templates/profilenavigation") ?>
<div class ="container-sm bg-l flex-column d-flex mt-3">
    <?php 
    if (!empty(session()->getFlashdata('succes'))){
        echo  '<div class="alert alert-success">';
        echo session()->getFlashdata("succes");
        echo "</div>";
    } ?>
    <?php 
    if (!empty(session()->getFlashdata('failed'))){ 
        echo  '<div class="alert alert-danger">';
        echo session()->getFlashdata("failed");
        echo "</div>";
    } ?>
 
    <form name="store_product" action="<?= base_url("/update_product/".$product[0]->ProductId) ?>" method="post" enctype="multipart/form-data" id="ProductForm">
        <div class="form-group mb-3"> 
            <label for="title" class="form-label">Title</label>
            <input id="titleInput" name="title" type="text" value="<?= $product[0]->Title ?>" class="form-control" placeholder="Title...">
            <span id="title-error">
                <?php if (!empty(session()->getFlashData('title'))): ?>
                    <?= session()->getFlashData('title') ?>
                <?php endif ?>
            </span>
        </div>
        
        <div class="form-group mb-3">
            <label for="price" class="form-label">Price</label>
            <input id="priceInput" name="price" type="text" class="form-control" value="<?= $product[0]->Price ?>" placeholder="Price...">
            <span id="price-error">
                <?php if (!empty(session()->getFlashData('price'))): ?>
                    <?= session()->getFlashData('price') ?>
                <?php endif ?>
            </span>
        </div>

        <div class="form-group mb-3">
            <label for="type" class="form-label">Choose the type of energy</label>
            <select id="typeInput"  name = "type" class="form-select">
            <option value="Aardgas">Aardgas</option>
            <option value="Biogas">Biogas</option>
            <option value="Butaan">Butaan</option>
            <option value="Propaan">Propaan</option>
            <option value="Aardolie">Aardolie</option>
            <option value="Synthetische olie">Synthetische olie</option>
            <option value="Pellets">Pellets</option>
            <option value="Briketten">Briketten</option>
            <option value="Brandhout">Brandhout</option>
            <option value="Deelbare energie">Deelbare energie</option>
            </select>
            <span id="type-error">
                <?php if (!empty(session()->getFlashData('type'))): ?>
                    <?= session()->getFlashData('type') ?>
                <?php endif ?>
            </span>
        </div>
            
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="descriptionInput" name="description" rows = "20" class="form-control" aria-label="With textarea"><?= $product[0]->Description ?></textarea>
            <span id="description-error">
                <?php if (!empty(session()->getFlashData('description'))): ?>
                    <?= session()->getFlashData('description') ?>
                <?php endif ?>
            </span>
        </div>

        <div class="form-group mb-3">
            <label for="origin" class="form-label">Origin</label>
            <textarea id="originInput" name="origin" class="form-control" aria-label="With textarea"><?= $product[0]->Origin ?></textarea>
            <span id="origin-error">
                <?php if (!empty(session()->getFlashData('origin'))): ?>
                    <?= session()->getFlashData('origin') ?>
                <?php endif ?>
            </span>
        </div>

        <div class="form-group mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input id="quantityInput" name="quantity" type="text" class="form-control" value="<?= $product[0]->Quantity ?>" placeholder="Quantity...">
            <span id="quantity-error">
                <?php if (!empty(session()->getFlashData('quantity'))): ?>
                    <?= session()->getFlashData('quantity') ?>
                <?php endif ?>
            </span>
        </div>

        <label for="delete image" class="form-label">Select the images/videos that you want to delete</label>
        <div id = "container">
            <?php foreach($images as $image): ?>
                <div class="gallery">
                    <?php if(!(substr($image, strlen($image)-3) == "mp4" || substr($image, strlen($image)-3) == "mkv")): ?>
                    <img src="<?= base_url('/Product_uploads/'.$image) ?>" class="gallery-image">
                    <?php else: ?>
                    <video class="gallery-image overflow-hidden">
                        <source src="<?= base_url('/Product_uploads/'.$image) ?>" type="video/mp4">
                        <source src="<?= base_url('/Product_uploads/'.$image) ?>" type="video/mkv">
                        Your browser does not support the video tag.
                    </video>
                    <?php endif; ?>
                    <input name= "delete image[]" class="form-check-input mt-0" type="checkbox" value="<?= $image ?>" aria-label="Checkbox for following text input">
                </div> 
            <?php endforeach; ?>
        </div>
        
        <div class="form-group mb-3">
            <label for = "images" class="form-label">Add images or videos you want to add</label>
            <input id= "files-upload" class="form-control" name="images[]" multiple type="file"/>
            <?php if (!empty(session()->getFlashData('images'))): ?>
                <span><?= session()->getFlashData('images') ?></span>
            <?php endif ?>
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <input type="submit" class="btn btn-success" name="submit" value="Update" aria-label="save the changes made to product"/>
        </div> 
    </form>
</div>
<?= $this->endsection() ?>
<?= $this->section("javascript") ?>
<script src="/productValidation.js"></script>
<?= $this->endsection() ?>

