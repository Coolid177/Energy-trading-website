<?= $this->section("title") ?>
myproducts
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<?= $this->include("templates/profilenavigation") ?>
<div class="container main-container">
  <div class="container">
  <?php 
    if (!empty(session()->getFlashdata('status'))){
        echo  '<div class="alert alert-success">';
        echo session()->getFlashdata("status");
        echo "</div>";
    } ?>
    <?php if (empty($products)): ?>
      <div class="alert alert-info" role="alert">
        You don't have any products 
      </div>
    <?php endif ?>
    <?php foreach($products as $product): ?>
    <div class="card mb-3">
      <div class="clickable">
        <a href="<?= "/product/".$product->ProductId ?>">
          <span class="link"></span>
        </a>
        <h5 class="card-header"><?= $product->Title?></h5>
        <div class="card-body height-auto">
          <div class = "d-flex flex-row">
            <div class="flex-column">
              <div class="row mb-2">
                <div class="col"><?= $product->Price ?>€</div>
                <div class="col"><?= $product->Origin ?></div>
                <div class="col"><?= $product->ProductType ?></div>
                <div class="col"><?= $product->Quantity ?></div>
              </div>
            </div>
          </div>
          <p class="card-text"> <?= $product->Description ?></p>
        </div>
      </div>
      <div class="d-flex flex-row ms-auto mb-2">
        <div class="d-flex flex-column me-2">
          <a href = "<?= "/profile/myProducts/edit/".$product->ProductId ?>" class="btn btn-success" aria-label="click this to edit the product">Edit</a>
        </div>
        <div class="d-flex flex-column me-2">
          <a href="<?= base_url('/delete_product/'.$product->ProductId) ?>" class="btn btn-danger" aria-label="click this to delete the product">Delete</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?= $this->endsection() ?>