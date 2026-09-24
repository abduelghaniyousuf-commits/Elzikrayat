<?php
class Result
{
  public $student;
  public $statusCode;

  public function __construct(object $student, int $statusCode)
  {
    $this->student = $student;
    $this->statusCode = $statusCode;
  }
}
