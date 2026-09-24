<?php  var_dump($origin['path']);
    $pathParameter ='';
    $exploded = explode('/',$origin);
    // print_r($exploded);
    foreach(array_values($exploded) as $value){

    // echo $value .'<br>' ,PHP_EOL ;
    if(preg_match("{[1-9]}",$value,$matches)){
        // echo "<br>".$value;

    }


    }
        echo ($matches[0]);

    echo $pathParameter;

if($_SERVER['REQUEST_URI'] == "/random"){
    $students = $std->getAll();
    require_once "views/Random.php";

}
?>