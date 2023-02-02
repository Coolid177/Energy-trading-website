<?= $this->section("title") ?>
products
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<div class="container mb-4">
    <div class="filter-box d-flex flex-column align-items-center">
        <form action="/FilterProducts" method="get">
            <div>
                <a>Soort energie</a>
                <div>
                    <input class="form-check-input" type= "checkbox" name="gas" id = "gasClick" value="1">
                    <label for="gas" aria-label="filter with gas as option">Gas</label>
                    <div id="gasSubCategorie" class="display-none">
                        <ul class="filter-padding list-style-none m-0">
                        <li>
                            <input class="form-check-input gas" type= "checkbox" name="aardgas" value="1">
                            <label for="aardgas"class="form-label" aria-label="filter with aardgas as option">Aardgas</label>
                        </li>
                        <li>
                            <input class="form-check-input gas" type= "checkbox" name="biogas" value="1">
                            <label for="biogas" class="form-label"aria-label="filter with biogas as option">Biogas</label>
                        </li>
                        <li>
                            <input class="form-check-input gas" type= "checkbox" name="butaan" value="1">
                            <label for="butaan" class="form-label"aria-label="filter with butaan as option">Butaan</label>
                        </li>
                        <li>
                            <input class="form-check-input gas" type= "checkbox" name="propaan" value="1">
                            <label for="propaan" class="form-label"aria-label="filter with propaan as option">Propaan</label>
                        </li>
                        <ul>
                    </div>
                </div>
                <div>
                    <input class="form-check-input" type= "checkbox" name="oil" id = "oilClick" value="1">
                    <label for="oil" aria-label="filter with oil as option">Olie</label>
                    <div id="oilSubCategorie" class="display-none">
                        <ul class="filter-padding list-style-none m-0">
                        <li>
                            <input class="form-check-input oil" type= "checkbox" name="aardolie" value="1">
                            <label for="aardolie" class="form-label"aria-label="filter with aardolie as option">Aardolie</label>
                        </li>
                        <li>
                            <input class="form-check-input oil" type= "checkbox" name="synthetische olie" value="1">
                            <label for="synthetische olie" class="form-label"aria-label="filter with syntetic oil as option">Synthetische olie</label>
                        </li>
                        <ul>
                    </div>
                </div>
                <div>
                    <input class="form-check-input" type= "checkbox" name="wood" id= "woodClick" value="1">
                    <label for="wood" aria-label="filter with wood as option">Hout</label>
                    <div id="woodSubCategorie"  class="display-none">
                        <ul class="filter-padding list-style-none m-0">
                        <li>
                            <input class="form-check-input wood" type= "checkbox" name="pellets" value="1">
                            <label for="pellets"class="form-label" aria-label="filter with pellets as option">Pellets</label>
                        </li>
                        <li>
                            <input class="form-check-input wood" type= "checkbox" name="briketten" value="1">
                            <label for="briketten"class="form-label" aria-label="filter with briketten as option">Briketten</label>
                        </li>
                        <li>
                            <input class="form-check-input wood" type= "checkbox" name="brandhout" value="1">
                            <label for="brandhout" class="form-label"aria-label="filter with brandhout as option">Brandhout</label>
                        </li>
                        <ul>
                    </div>
                </div>
                <div>
                    <input class="form-check-input" type= "checkbox" name="sharingEnergy" value="1">
                    <label for="sharingEnergy" class="form-label"aria-label="filter with sharing energy as option">Deelbare energie</label>
                </div>
            </div>
            <div class="full-width">
                <a> Maximale prijs </a>
                <label for="max price" aria-label="filter with a max price"></label>
                <input type="number" class="form-control full-width" min="1" name="max price">
            </div>
            <div>
                <a> Beschikbaarheid </a>
                <div>
                    <input class="form-check-input" type="checkbox" name="supply" value="1">
                    <label for="supply" class="form-label" aria-label= "filtered products must be in stock">Op voorraad</label>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-start">
                <input type="submit" class="btn btn-success" value="Filter" aria-label="send the filter requirements"/>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="d-flex row g-3 justify-content-center items">
            <?php if (empty($items)): ?>
            <div class="alert alert-info mt-4 justify-content-start" role="alert">
                No products found, try to change your criteria
            </div>
            <?php endif; ?>
            <!-- start item-->
            <?php foreach ($items as $product): ?> 
            <div class="clickable product">
                <a href="/product/<?= $product->ProductId ?>">
                <span class="link"></span>
                </a> 
                <div class="card shadow-sm">
                    <!-- start image -->
                    <?php if(!(substr($product->Media_name, strlen($product->Media_name)-3) == "mp4" || substr($product->Media_name, strlen($product->Media_name)-3) == "mkv")): ?>
                    <img src="<?= base_url('/Product_uploads/'.$product->Media_name) ?>" class="card-img-top" width="100%" height="225px">
                    <?php else: ?>
                    <video class="card-img-top overflow-hidden" width="100%" height="225px">
                        <source src="<?= base_url('/Product_uploads/'.$product->Media_name) ?>" type="video/mp4">
                        <source src="<?= base_url('/Product_uploads/'.$product->Media_name) ?>" type="video/mkv">
                        Your browser does not support the video tag.
                    </video>
                    <?php endif; ?>
                    <!-- end image -->
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <text class="text-truncate product-titel">
                                    <?= $product->Title ?>
                                </text>
                                <text class = "price">€<?= $product->Price ?></text>
                            </div>
                            <div class="d-flex flex-column">
                                <?php if($product->Quantity == 0): ?>
                                <text class="color-red">Uitverkocht</text>
                                <?php else: ?>
                                <text class="color-green">Op voorraad</text>
                                <?php endif ?>
                                <text class="text-truncate">Herkomst: <?= $product->Origin ?></text>
                                <text class="text-truncate">Soort energie: <?= $product->ProductType ?></text>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endsection() ?>
<?= $this->section("javascript") ?>
<script src="/products.js"></script>
<?= $this->endsection() ?>