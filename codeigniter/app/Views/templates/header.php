<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
    <link href="<?= base_url('/CSS/Login.css') ?>" rel="stylesheet">
    <link rel="shortcut icon" href="Public_images/page_icon.ico">
    <link href="<?= base_url('/CSS/Main.css') ?>" rel="stylesheet">
  </head>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
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
  <body class="d-flex flex-column">
    <!-- navbar start-->
    <nav class="navbar navbar-expand-lg bg-lg-green">
        <div class="container-fluid">
            <nav class="navbar bg-green">
              <div class="container-fluid">
                <a class="navbar-brand" href="/home">Energetic</a>
              </div>
            </nav>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button> 
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/profile/profile">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/shoppingcart">Shopping cart</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/messages">Messages</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/products">Products</a>
                </li>
                <?php 
                if (session()->get('LoggedIn')){
                echo '<li class="nav-item">';
                  echo '<a class="nav-link active" aria-current="page" href="/logout">Logout</a>';
                echo '</li>';
                }
                ?>
              </ul>
              <!-- searchbar start -->
              <form class="d-flex" role="search" action="/product/search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button type = "submit" class = "material-icons">search</button>
              </form>
              <!-- end searchbar -->
            </div>
        </div>
    </nav>
    <!-- end navbar -->