<?php
class PhotoController
{
  public $data;

  function index()
  {
    // echo "triggered";
    $pModel = new PhotoModel();
    $this->data = $pModel::getAll();
    if ($this->data && count($this->data) >= 1) {
      $pView = new PhotoView($this->data);
      $pView->viewAll();
    }
    die();
  }

  public function viewById(int $id)
  {
    $pModel = new PhotoModel();
    $data = $pModel::getByID($id);
    if (isset($data)) {
      $pView = new PhotoView($this->data);
      $pView->viewOne();
    }
    die();
  }
}
