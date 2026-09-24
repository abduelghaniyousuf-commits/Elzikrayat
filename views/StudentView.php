<?php

class StudentView
{
  public $data;

  function __construct(object $data)
  {
    $this->data = $data;
  }

  function index()
  {
    $data = $this->data;

    require_once("./views/partials/header.php");
    require_once("./views/partials/heroes.php");
  }

  function profile()
  {
    $data = $this->data;
    require_once("./views/partials/header.php");
    require_once("./views/partials/profile.php");

  }
}
