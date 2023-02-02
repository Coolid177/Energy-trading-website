<?= $this->section("title") ?>
create product
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
    <form name="store_product" action="store_product" method="post" enctype="multipart/form-data" id="ProductForm">
        <div class="form-group mb-3"> 
            <label for="title" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" placeholder="Title..." id="titleInput">
            <span id="title-error">
                <?php if (!empty(session()->getFlashData('title'))): ?>
                    <?= session()->getFlashData('title') ?>
                <?php endif ?>
            </span>
        </div>
        
        <div class="form-group mb-3">
            <label for="price" class="form-label">Price</label>
            <input name="price" type="text" class="form-control" placeholder="Price..." id="priceInput">
            <span id="price-error">
                <?php if (!empty(session()->getFlashData('price'))): ?>
                    <?= session()->getFlashData('price') ?>
                <?php endif ?>
            </span>
        </div>

        <div class="form-group mb-3">
            <label for="type" class="form-label">Choose the type of energy</label>
            <select name = "type" class="form-select" id="typeInput">
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
            <span id = "type-error">
            <?php if (!empty(session()->getFlashData('type'))): ?>
                    <?= session()->getFlashData('type') ?>
                <?php endif ?>
            </span>
        </div>
            
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" aria-label="With textarea" id="descriptionInput"></textarea>
            <span id="description-error">
                <?php if (!empty(session()->getFlashData('description'))): ?>
                    <?= session()->getFlashData('description') ?>
                <?php endif ?>
            </span>
        </div>

        <div class="form-group mb-3">
            <label for="origin" class="form-label">Origin</label>
            <input name="origin" class="form-control" aria-label="With textarea" id="originInput"></input>
            <span id="origin-error">
                <?php if (!empty(session()->getFlashData('origin'))): ?>
                    <?= session()->getFlashData('origin') ?>
                <?php endif ?>
            </span>
        </div>

        <div class="form-group mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input name="quantity" type="text" class="form-control" placeholder="Quantity..." id="quantityInput">
            <span id="quantity-error">
                <?php if (!empty(session()->getFlashData('quantity'))): ?>
                    <?= session()->getFlashData('quantity') ?>
                <?php endif ?>
            </span>
        </div>
        
        <div class="form-group mb-3">
            <label for="images" class="form-label">Images or videos</label>
            <input class="form-control" name="images[]" multiple type="file"/>
            <?php if (!empty(session()->getFlashData('images'))): ?>
                <span><?= session()->getFlashData('images') ?></span>
            <?php endif ?>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <input type="submit" class="btn btn-success" name="submit" value="Create product" aria-label="create the product"/>
        </div> 
    </form>
</div>
<?= $this->endsection() ?>
<?= $this->section("javascript") ?>
<script src="/productValidation.js"></script>
<?= $this->endsection() ?>

