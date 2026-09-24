<?php

// use const Dom\VALIDATION_ERR;

class AuthenticationController
{

  // Data





  function __construct() {}


  // functions

  // sign Up
  // signs up a user with required name , password , and email 
  // sanitizes encoming data & and validates it using validator validate functions 
  // encoming data includes fname , lname ,password ,email 
  // tests if input is valid , calls the student model , and triggers insert function
  // insert function checks whether the user is signed before 
  // if not signed before
  // signs the new student
    // redirects to login page
    // if successed return 201 insertion completed
  // if signed before return message user is signed 
  // redirects user to login page

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
      // echo "no data in auth/login";
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
        if ($this->updateUserLoginState("login", $std->id)) {
          return $std;
        }
      }
    }
    $std = null;
    return $std;
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

  function updateUserLoginState(string $state, $id): bool
  {
    if (isset($state) && isset($id)) {

      $sModel = new StudentModel;

      switch ($state) {
        case "login":
          //
          return $sModel->updateStateLogin($id);

        case "logout":
          return $sModel->updateStateLogout($id);
          //

        default:
          return false;
      }
    } else {
      return false;
    }
  }


  // log out

  function logOut($id): bool
  {
    if (!isset($id)) {
      return false;
    }
    $sModel = new StudentModel;
    $std = $sModel->find($id);
    if ($std) {
      // update 
      return  $this->updateUserLoginState("logout", $id);
    } else {
      return false;
    }
  }


  // signOut



}
