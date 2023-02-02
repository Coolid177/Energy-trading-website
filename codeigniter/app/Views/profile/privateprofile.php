<?= $this->section("title") ?>
private profile
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<?= $this->include("templates/profilenavigation") ?>
<form name="update_profile" method="post" action="<?= base_url('/profile/update') ?>" enctype="multipart/form-data" id="updateProfileForm">
    <div class="container main-container">
        <?php  
        if (!empty(session()->getFlashdata('success'))){
            echo  '<div class="alert alert-success">';
            echo session()->getFlashdata("success");
            echo "</div>";
        } ?>
        <?php 
        if (!empty(session()->getFlashdata('fail'))){ 
            echo  '<div class="alert alert-danger">';
            echo session()->getFlashdata("fail");
            echo "</div>";
        } ?>
        <?php if (!empty(session('isVendor')) && session('isVendor')): ?>
        <?php if (!empty($images)) 
        echo "<label>Select the images/videos that you want to delete</label>"
        ?>
        <div id = "container">
        <?php foreach($images as $image): ?>
            <div class="gallery">
                <?php if(!(substr($image->Media_name, strlen($image->Media_name)-3) == "mp4" || substr($image->Media_name, strlen($image->Media_name)-3) == "mkv")): ?>
                <img src="<?= base_url('/Profile_uploads/'.$image->Media_name) ?>" class="gallery-image">
                <?php else: ?>
                <video class="gallery-image overflow-hidden">
                    <source src="<?= base_url('/Profile_uploads/'.$image->Media_name) ?>" type="video/mp4">
                    <source src="<?= base_url('/Profile_uploads/'.$image->Media_name) ?>" type="video/mkv">
                    Your browser does not support the video tag.
                </video>
                <?php endif; ?>
                <input name= "delete image[]" class="form-check-input mt-0" type="checkbox" value="<?= $image->Media_name ?>" aria-label="Checkbox for following text input">
            </div> 
        <?php endforeach; ?>
        </div>
        <div class="form-group">
            <label for = "files-upload" class="form-label">Choose images or videos you want to add</label>
            <input id= "files-upload" class="form-control" name="images[]" multiple type="file"/>
            <span>
                <?php if (!empty(session()->getFlashData('images'))): ?>
                    <?= session()->getFlashData('images') ?>
                <?php endif ?>
            </span>
        </div>
        <?php endif; ?>
        <div class="col input-group mt-4">
            <span class="input-group-text width-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                </svg>
            </span>
            <a type="text" class="form-control bg-white"><?= $userData[0]->Fname." ".$userData[0]->Lname ?></a>
        </div>
        <div class="col profile-tag input-group mt-4">
            <span class="input-group-text width-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                </svg>
            </span>
            <a type="text" class="form-control bg-white"><?= $userData[0]->Email ?></a>
        </div>
        <?php if(!empty(session('isVendor')) && session('isVendor')): ?>
        <div class="col profile-tag input-group mt-4">
            <span class="input-group-text width-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                    <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                    <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                </svg> 
            </span>
            <label for="new phone number"class="form-label"  aria-label="change the phone number"></label>
            <input id="phoneNumberInput" name= "new phone number" class="form-control" value="<?= $userData[0]->Phone_number ?>">
        </div>
        <span id="phone_number-error">
            <?php if (!empty(session()->getFlashData('new_phone_number'))): ?>
                <?= session()->getFlashData('new_phone_number') ?>
            <?php endif ?>
        </span>
        <div class="col profile-tag input-group mt-4">
            <span class="input-group-text width-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z"/>
                <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z"/>
                </svg>
            </span>
            <label for="new company" class="form-label" aria-label="change the company"></label>
            <input id="companyInput" type="text" class="form-control" name="new company" value="<?= $userData[0]->Company ?>">
        </div>
        <span id="company-error">
            <?php if (!empty(session()->getFlashData('new_company'))): ?>
                <?= session()->getFlashData('new_company') ?>
            <?php endif ?>
        </span>
        <div class="text-align-justify mt-4">   
            <label for = "new description" class="form-label" aria-label="change the description">Description</label>
            <textarea id="documentInput" class="form-control" rows="20" name="new description"><?= $userData[0]->Description ?></textarea>
            <span id="description-error">
                <?php if (!empty(session()->getFlashData('new_description'))): ?>
                    <?= session()->getFlashData('new_description') ?>
                <?php endif ?>
            </span>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success mt-4" type="submit" aria-label ="save the changes made to the profile">Save changes</button>
        </div>
        <?php endif; ?>
    </div>
</form>
<?= $this->endsection() ?>
<?= $this->section("javascript") ?>
<script src="/profile.js"></script>
<?= $this->endsection() ?>