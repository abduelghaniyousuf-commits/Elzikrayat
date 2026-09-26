<?php
// spl_autoload_register
// loads classes files dynamically
// take a callback function as parameter 
// the call back takes a string of the class name called in code
// using standard bascal case to gain benefits of the class name returned by the call function 
// to load the classes called
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


// $sModel = new StudentModel;
// $valiCTRL = new ValidationController;
// $student = new stdClass;
// $student->id = 10;

// $password = $valiCTRL->hash("password");
// $student->password = $password;
// echo json_encode($student);
// echo "<br>";

// $student = $sModel->update($student);
// if ($student) {
//     echo json_encode($student);
//     echo "<br>";
// }
// die();
$userId = 0;

$std = new StudentModel();
$origin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// die();

// Router::get('/home/{id}', function ($matches) {

//     echo "home/id is handled";
// });
Router::get("/", function () {
    Router::redirect("login");
});


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

        Router::redirect("/login");
        // die();
    }
});
// registeration
// GET /register
// views SignIn view that contains SignIn form
Router::get("/register", function () {
    $sController = new StudentController();
    $sController->signUpView();
});
//  Post /register
// takes user input from payload 
// sanitizes and validates user input
// returns the result os sign up operation
// redirects user to login page in successful sign up
// continuing tomorrow inshAllah
Router::post("/register", function () {
    // echo json_encode($_POST);
    $stdAuthenticator = new AuthenticationController;
    // the result of sign up operation
    // the result is object contains:
    //1- student object contains the data inserted before + a message shows:
    // a- success if data was valid and inserted to data base
    // b- database error if any DB error happens
    // c- or validation errors 
    // 2- status code explains the status of insertion operation
    $resut = $stdAuthenticator->signUp((object)$_POST);

    // $userId = $signedUser->id;
    // echo $userId;
    Router::redirect("/login");
});

// Get /login 
// views the login view that contains login form
Router::get("/login", function () {
    // echo "triggered";
    // die();
    $sController = new StudentController();
    $sController->loginView();
});


// post /login 
// takes user email &password
// finds user with the specific email
// brings the hashed password with the user input password
// if matches ,changes the state of user to login
// redirects user to /user/idOfTheUser
// if not match ,redirects user for the login page to try again
Router::post("/login", function () {
    $authController = new AuthenticationController;
    $std = $authController->logIn((object)$_POST);
    // echo json_encode($std);
    // die();

    if (isset($std)) {
        // $userId = $std->id;
        Router::redirect("/user/" . $std->id . "");
    } else {
        Router::redirect("/login");
    }
});


// GET /logout/UserId
// takes user id (from the url)and set it satatus isLogin = false
// redirects user to /login page
// if any error happens and the staus of user isLogin = true redirects user to /user/{userId}
Router::get("/logout/{id}", function ($matches) {

    $userId = $matches;
    $stdAuthenticator = new AuthenticationController;

    if ($stdAuthenticator->logOut($userId)) {
        Router::redirect("/login");
    } else {
        Router::redirect("user/" . $userId);
    }
    // $sModel = new StudentModel;
    // echo $sModel->find($userId)->first_name;
    // echo $sModel->find($userId)->isLogin;

    // die();
});

Router::get("/photo/{id}", function ($matches) {
    $photoId = $matches;
    // echo json_encode($photoId);

    if ($photoId) {
        $pController = new PhotoController;

        $photo = $pController->viewById($photoId);
        $cConroller = new CommentCOntroller;
        $cConroller->index();
        // echo "from here";
        // echo json_encode($photo);

    } else {
        http_response_code(504);
        echo "<h>Server Error Photo not found</h1>";
    }
});




// url dispatcher engine
Router::dispatch($origin);
