<?php
// require_once "./models/CommenModel.php";
class CommentController
{

  static $data;

  function index()
  {
    // $data = $this->data;
    $cModel = new CommentModel;
    $comments = $cModel->getAll();
    $cView = new Comment($comments);
    $cView->index();
  }
}
