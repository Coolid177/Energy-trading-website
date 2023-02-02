<?= $this->section("title") ?>
Home
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
  <?=$this->section("symbols") ?>
  <svg xmlns="http://www.w3.org/2000/svg" class="display-none">
    <symbol id="shared energy" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M1 8a7 7 0 1 1 2.898 5.673c-.167-.121-.216-.406-.002-.62l1.8-1.8a3.5 3.5 0 0 0 4.572-.328l1.414-1.415a.5.5 0 0 0 0-.707l-.707-.707 1.559-1.563a.5.5 0 1 0-.708-.706l-1.559 1.562-1.414-1.414 1.56-1.562a.5.5 0 1 0-.707-.706l-1.56 1.56-.707-.706a.5.5 0 0 0-.707 0L5.318 5.975a3.5 3.5 0 0 0-.328 4.571l-1.8 1.8c-.58.58-.62 1.6.121 2.137A8 8 0 1 0 0 8a.5.5 0 0 0 1 0Z"/>
    </symbol>
    <symbol id="oil" viewBox="0 0 16 16">
      <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6ZM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13Z"/>
    </symbol> 
    <symbol id="gas" viewBox="0 0 16 16">
      <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
    </symbol>
    <symbol id="wood" viewBox="0 0 16 16">
      <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5zM6.437 4.758A.5.5 0 0 0 6 4.5h-.066L8 1.401 10.066 4.5H10a.5.5 0 0 0-.424.765L11.598 8.5H11.5a.5.5 0 0 0-.447.724L12.69 12.5H3.309l1.638-3.276A.5.5 0 0 0 4.5 8.5h-.098l2.022-3.235a.5.5 0 0 0 .013-.507z"/>
    </symbol>
  </svg>
  <?= $this->endsection() ?>
<?= $this->section("content") ?>
<!-- start who are we -->
<div class="container col-xxl-8 px-4 py-5 bg-white">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold lh-1 mb-3">Who are we? </h1>
      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint laudantium vitae asperiores quos quaerat dolorum delectus magnam minus hic cum illum nemo veritatis, recusandae unde eaque numquam, libero harum suscipit!</p>
    </div>
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="<?= base_url('Public_images/new-image4.jpg') ?>" class="d-block mx-lg-auto img-fluid" alt="green energy" width="700" height="500" loading="lazy">
    </div>
  </div>
</div>
<!-- end who are we -->

<!-- start what do we provide -->
<div class="container px-4 py-5" id="icon-grid">
  <h2 class="pb-2 border-bottom">What do we provide?</h2>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
    <div class="col d-flex align-items-start">
      <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#wood"/></svg>
      <div>
        <h3 class="fw-bold mb-0 fs-4">Hout</h3>
        <p>Het hout is van lokale afkomst, zo hoeft u nooit lang te wachten tot het bij u is!</p>
      </div>
    </div>
    <div class="col d-flex align-items-start">
      <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#gas"/></svg>
      <div>
        <h3 class="fw-bold mb-0 fs-4">Gas</h3>
        <p>Gas van de beste kwaliteit</p>
      </div>
    </div>
    <div class="col d-flex align-items-start">
      <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#oil"/></svg>
      <div>
        <h3 class="fw-bold mb-0 fs-4">Olie</h3>
        <p>Onze verkopers hun olie is altijd van de puurste vorm</p>
      </div>
    </div>
    <div class="col d-flex align-items-start">
      <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#shared energy"/></svg>
      <div>
        <h3 class="fw-bold mb-0 fs-4">Deelbare energie</h3>
        <p>Verkopers kunnen kiezen of ze hun groene-zelf opgewekte energie willen verkopen aan anderen. </p>
      </div>
    </div>       
  </div>
</div>
<!-- end what do we provide -->

<!-- start why choose us -->
<div class="container col-xxl-8 px-4 py-5 bg-white">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="<?= base_url('Public_images/new-image5.jpg') ?>" class="d-block mx-lg-auto img-fluid" alt="why choose us" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold lh-1 mb-3">Why choose us?</h1>
      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam aut voluptates enim, recusandae quasi, perferendis nihil consequatur quibusdam quo accusamus consectetur quod reprehenderit repellendus culpa minima ut, modi aperiam eaque!</p>
    </div>
  </div>
</div>
<!-- end why choose us -->
<?= $this->endsection() ?>