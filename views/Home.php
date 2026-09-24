<?php
class Home
{

    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }



    public function index()
    {
        foreach ($this->students as $student) {
            echo "<li>" . $student->first_name  . "</li>";
        }
    }
}
