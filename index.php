<?php

use function PHPSTORM_META\type;

spl_autoload_register(function (string $className) {

    $paths = [
        __DIR__ . '/config/',
        __DIR__ . '/core/',
        __DIR__ . '/controllers/',
        __DIR__ . '/views/',
        __DIR__ . '/models/'
    ];
    foreach ($paths as $path) {
        $path = str_replace("\\", '/', $path);
        $fileName = $path . $className . '.php';
        if (file_exists($fileName)) {
            require_once $fileName;
        }
    }
});



$userId = 0;

$std = new StudentModel();
$origin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// die();

// Router::get('/home/{id}', function ($matches) {

//     echo "home/id is handled";
// });

// landing page after login
Router::get('/user/{id}', function ($matches) {
    // echo json_encode($matches);
    // echo "<br>";
    // die();
    $userId = $matches ?? "";
    $authController = new AuthenticationController;

    if ($authController->userCurrenState($userId)) {
        // echo $userId;
        $sController = new StudentController;
        $sController->index($userId);

        $pController = new PhotoController();
        $pController->index();
    } else {
        // echo $userId;
        // echo "from here";
        // Router::redirect("/login", 302);
        // user not found page / 404

        Router::redirect("/login", 200);
        // die();
    }
});
// registeration
Router::get("/register", function () {
    $sController = new StudentController();
    $sController->signUpView();
});
Router::post("/register", function () use ($userId) {
    // echo json_encode($_POST);
    $stdAuthenticator = new AuthenticationController;
    $signedUser = $stdAuthenticator->signUp((object)$_POST);

    // $userId = $signedUser->id;
    // echo $userId;
    Router::redirect("/login", 201);
});

// login routes

Router::get("/login", function () {
    // echo "triggered";
    // die();
    $sController = new StudentController();
    $sController->loginView();
});

Router::post("/login", function () {
    $authController = new AuthenticationController;
    $std = $authController->logIn((object)$_POST);

    if (isset($std)) {
        $userId = $std->id;
        Router::redirect("/user/" . $std->id . "", 201);
    } else {
        Router::redirect("/login", 200);
    }
});

Router::get("/logout/{id}", function ($matches) {

    $userId = $matches;
    $stdAuthenticator = new AuthenticationController;

    $stdAuthenticator->logOut($userId);
    // $sModel = new StudentModel;
    // echo $sModel->find($userId)->first_name;
    // echo $sModel->find($userId)->isLogin;

    // die();

    Router::redirect("/login", 200);
});





Router::dispatch($origin);
