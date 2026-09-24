<?php
class StudentController
{


  function loginView()
  {
    $loginView = new LogIn;

    $loginView->index();
  }

  function signUpView()
  {
    $signUpView = new SignUp;
    $signUpView->index();
  }

  function index(int $id)
  {
    // echo $id;
    $sModel = new StudentModel;
    $std = $sModel->find($id);
    if ($std) {
      $stdView = new StudentView($std);
      // echo "from here";
      $stdView->index();
    }
  }
}
