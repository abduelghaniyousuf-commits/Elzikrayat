<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Elzikrayat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>

  </style>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Elzikrayat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">Home</a> </li>
            <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">Profile</a> </li>
            <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">About Us</a> </li>
          </ul>
          <!-- <form class="d-flex" role="search"> <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form> -->
          <form action="/logout/<?php echo $data->id; ?> " method="get" class="d-flex">
            <button id="logout" type="button" class="btn btn-primary" onclick="this.form.submit()">Log Out</button>
          </form>
        </div>
      </div>
    </nav>
  </div>