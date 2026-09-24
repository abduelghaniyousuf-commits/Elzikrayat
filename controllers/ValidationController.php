<?php

class ValidationController
{


  public $message;
  public $error;


  public function __construct() {}



  // sanitize user input

  function SanitizeInput(string $dataField): ?string
  {
    return filter_var($dataField, FILTER_SANITIZE_SPECIAL_CHARS);
  }




  // validate name 

  function isValidName(string $name): bool
  {


    $isValid = true;
    $local_name = $this->SanitizeInput($name);

    // check fo length or empty strings 
    if ($local_name) {
      if (strlen($local_name) < 3) {
        $isValid = false;
        $this->message = $this->message . "name must be at least 3 chars length";
        return $isValid;
      }
    }
    return $isValid;
  }

  // validate password
  function isValidPassword(string $password): bool
  {
    $isValid = true;
    $localPassword = $this->SanitizeInput($password);
    // echo $localPassword;

    if (!strlen($localPassword) >= 8) {
      $isValid = false;
      $this->message = $this->message = "Password must be at least 8 digits length\n";
    }
    return $isValid;
  }

  // hash password
  function hash(string $validPassword): string
  {
    $hash = password_hash($validPassword, PASSWORD_BCRYPT);
    return $hash;
  }

  // verify hash
  function verifyHash(string $validInput, string $hash): bool
  {
    $isTheSame = false;
    $isTheSame = password_verify($validInput, $hash);
    return $isTheSame;
  }
  // validate email


  function isValidEmail(string $email): bool
  {
    // echo "<br>";


    $isValid = true;
    $local_email = $this->SanitizeInput($email);
    if ($local_email) {

      if (!preg_match("#(@gmail\.com)#", $local_email)) {
        // echo "sanitized: " . $local_email;
        $isValid = false;
        $this->message = $this->message . "\nplease enter a valid email";
        return $isValid;
      }
    }
    return $isValid;
  }

  function getErrors()
  {
    $this->error = new Error($this->message);
    return $this->error->getMessage();
    // return $this->message;
  }
}
