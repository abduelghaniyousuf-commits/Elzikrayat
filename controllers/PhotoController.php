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

  public function viewById($id)
  {
    $pModel = new PhotoModel();
    $photo = $pModel::getByID($id);
    // echo json_encode($photo);
    // die();
    if (isset($photo)) {
      $this->data = $photo;
      $pView = new PhotoView($this->data);
      $pView->viewOne();
    }
    die();
  }
}
