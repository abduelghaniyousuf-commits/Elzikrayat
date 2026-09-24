<?php


class LogIn
{
  public $data;

  function index()
  {

    echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elzikrayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">Elzikrayat</a>
    </div>
   </nav>
  <body>
  ';

?>
    <div class="container col-lg-4 col-sm-8">
      <form action="/login" method="post">
        <!-- <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
        <h2 class="mb-4">Elzikrayat </h2>
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="form-floating mb-3"> <input type="text" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required maxlength="30""> <label for=" floatingInput">Email address</label> </div>
        <div class="form-floating"> <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required minlength="8"> <label for="floatingPassword">Password</label> </div>
        <!-- <div class="form-check text-start my-3"> -->
        <div class="container col-lg-8 mx-auto my-3">
          <p>Don't Have an Account <a href="/register">register</a></p>
        </div>
        <!-- <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault"> 
        <label class="form-check-label" for="checkDefault">
          Remember me
        </label> -->
        <button class="btn btn-primary w-100 py-2" type="submit">Log In</button>
        <p class="mt-5 mb-3 text-body-secondary">© 2026-2027</p>
      </form>
    </div>

<?php
    require_once "./views/partials/footer.php";
  }
}
?>