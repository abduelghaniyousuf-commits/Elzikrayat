<?php

// use const Dom\VALIDATION_ERR;

class AuthenticationController
{

  // Data





  function __construct() {}


  // functions

  // signIn
  // sign in a user with required name , password , and email 
  // sanitize encoming data & and validate it using validator validate functions 
  // encoming data include fname , lname ,password ,email 
  // if input is valid , call the student model , and trigger insert function
  // insert function check whether the user is signed before 
  // if not signed before
  // sign the new student
  // redirect to login page
  // if successed return 201 insertion completed
  // if signed before return message user is signed 
  // redirect user to login page

  function signUp($data): ?object
  {
    if (!isset($data)) {
      return null;
    }
    $newStudent = new stdClass();
    $statusCode = 201;

    if ($data) {
      $validator = new ValidationController();
      if ($validator->isValidName($data->first_name) && $validator->isValidName($data->last_name) && $validator->isValidEmail($data->email) && $validator->isValidPassword($data->password)) {
        $newStudent->first_name = $data->first_name;
        $newStudent->last_name = $data->last_name;
        $newStudent->password = $validator->hash($data->password);
        $newStudent->email = $data->email;
        $sModel = new StudentModel;
        // after inserion to database
        if ($sModel->insert($newStudent)) {
          $statusCode = 201;
          $newStudent->message = "successed";
        } else {
          $statusCode = 501;
          $newStudent->message = "Database error";
        }
      } else {
        $newStudent->message = $validator->getErrors();
        $statusCode = 501;
      }
    }
    $result = new Result($newStudent, $statusCode);
    // echo json_encode($result);

    return $result;
  }

  // login

  function logIn(object $data): ?object
  {

    if (!isset($data)) {
      echo "no data in auth/login";
      return null;
    }
    $std = new stdClass;
    $sModel = new StudentModel;
    $isRegistered = false;

    $validator = new ValidationController;

    if ($validator->isValidEmail($data->email) && $validator->isValidPassword($data->password)) {
      $std = $sModel->findByEmail($data->email);
      if (!isset($std)) {
        return null;
      }
      $hash = $std->password ?? "";
      $isRegistered  = $validator->verifyHash($data->password, $hash);
      if ($isRegistered) {
        $this->updateUserLoginState("login", $std->id);
        return $std;
      }
    }
    return $std = null;
  }

  // currentState

  function userCurrenState(string $id): bool
  {
    if (!isset($id)) {
      return false;
    }
    $isLogin = false;
    $sModel = new StudentModel;
    $std =  $sModel->find($id);
    if ($std) {
      $isLogin =  $std->isLogin;
    }
    return (bool) $isLogin;
  }


  // update user login State 

  function updateUserLoginState(string $state, $id)
  {
    if (isset($state) && isset($id)) {

      $sModel = new StudentModel;

      switch ($state) {
        case "login":
          //
          $sModel->updateStateLogin($id);
          break;
        case "logout":
          $sModel->updateStateLogout($id);
          //
          break;
        default:
          break;
      }
    } else {
      return;
    }
  }


  // log out

  function logOut($id)
  {
    if (!isset($id)) {
      return;
    }
    $sModel = new StudentModel;
    $std = $sModel->find($id);
    if ($std) {
      // update 
      $this->updateUserLoginState("logout", $id);
    }
  }


  // signOut



}
