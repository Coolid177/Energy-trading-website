<!doctype html>
<html lang="en" class="fullscreen">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
    <link href="<?= base_url('CSS/Login.css') ?>" rel="stylesheet">
  </head>
  <body class="maxVH"> 
      <div class="d-flex bg-gray align-content-stretch align-items-center max-height">
          <img class="hidden img-fluid max-height" src="<?= base_url('/Public_images/Login image.jpg') ?>">
          <div class="mx-auto justify-content-center">
              <div class="mx-auto justify-content-center">
                  <h1 class="mb-3"> Welcome back! </h1>
                  <h5 class="mb-4"> We're glad to see you again! </h5>
              </div> 
              <form class="mx-auto align-self-center" action="<?= base_url('/login') ?>" method="post">
                  <?= csrf_field() ?>
                  <?php 
                  if (!empty(session()->getFlashdata('login failed'))){
                      echo  '<div class="alert alert-danger">';
                      echo session()->getFlashdata("login failed");
                      echo "</div>";
                  }
                  ?>    
                  <?php if(!empty(session()->getFlashdata('acces denied'))){
                      echo  '<div class="alert alert-danger">';
                      echo session()->getFlashdata("acces denied");
                      echo "</div>";
                  } ?>
                  <?php if(!empty(session()->getFlashdata('account_created'))){
                      echo  '<div class="alert alert-success">';
                      echo session()->getFlashdata('account_created');
                      echo "</div>";
                  } ?>
                  <div class="mb-3">
                      <label for="Email" class="form-label" name="email">Email address</label>
                      <input  name="Email" type="email" class="form-control length-fixed-300 bg-light" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                      <label for="Password" class="form-label">Password</label>
                      <input type="password" class="form-control length-fixed-300 bg-light" name="Password" id="exampleInputPassword1">
                  </div>
                  <div class="spacing">
                      <button type="submit" class="btn btn-primary" aria-label="submit form">Login</button>
                  </div>
                  <div class="align-self-center">
                      <a>Don't have an account?</a>
                      <a href="<?= base_url("/create_account") ?>">Sign up now!</a>
                  </div>
              </form>
          </div> 
      </div>
  </body>
  <script></script>
</html>