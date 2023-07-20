<?php


function getUsers() {
    $usersData = scandir("data/usersDir");
    $users = array();
    foreach ($usersData as $userData) {
        $users[] = json_decode(file_get_contents($userData), true);
    }
    return $users;
}

function getUserByName($name) {
    if ($name != "") {
        $path = "data/usersDir/".$name.".json";
        if (file_exists($path)) {
            $user = json_decode(file_get_contents($path), true);
            return $user;
        } else {
            return false;
        }
    }
}

function validateUser($user, $password) {
    if ($user != null) {
        if($user["password"] == $password) {
            return true;       
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function loginAttempt() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = getUserByName($_POST["uName"]);
        $password = $_POST["passW"];
        if (validateUser($user, $password) === true) {
            $_SESSION["user"] = $user;
            header("Location: index.php" );
            exit();
        } 
        else if ($_POST["uName"] === "" || $password === "") {
            return "<div class='errorMessage'>Please fill all fields</div>";
        }
        else if (validateUser($user, $password) === false) {
            return "<div class='errorMessage'>Incorrect username or password</div>";
        }
    }
}

function logout() {
    if (isset($_SESSION["user"])) {
        session_destroy();
    }
    header("Location: index.php" );
    exit();
}

function getEpsWatched($seriesId, $user) {
    if (isset($user["watched"][$seriesId])) {
        return $user["watched"][$seriesId];
    } else {
        return 0;
    }
}

function changeWatched($seriesId) {
    if (isset($_POST["watch"])) {
        $series = getSeriesById($seriesId);
        $user = $_SESSION["user"];
        $watched = $user["watched"];

        $epsWatched = getEpsWatched($seriesId, $user);

        if (count($series["episodes"]) > $epsWatched) {
            if (isset($user["watched"][$seriesId])) {
                $watched[$seriesId] += 1;
            } else {
                $watched += [$seriesId => 1];
            }
            $user["watched"] = $watched;
            file_put_contents("data/usersDir/".$user["username"].".json", json_encode($user, JSON_PRETTY_PRINT|JSON_FORCE_OBJECT));
        }
       $_SESSION["user"] = $user;
    }
}

function createUser() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["uName"];
        $email = $_POST["email"];
        $password = $_POST["passW"];
        $passConfirm = $_POST["passWC"];

        if (strlen(trim($username)) == 0 || strlen(trim($email)) == 0 || strlen(trim($password)) == 0 || strlen(trim($passConfirm)) == 0) {
            return "<div class='errorMessage'>Please fill all fields</div>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "<div class='errorMessage'>Invalid email format</div>";
        }
        if (file_exists("data/usersDir/".$username.".json")) {
            return "<div class='errorMessage'>Username taken</div>";
        }
        if ($password !== $passConfirm) {
            return "<div class='errorMessage'>Passwords don't match</div>";
        }

        $id = substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,51 ) ,1 ) .substr( md5( time() ), 1);
        $user = array("id" => $id, "username" => $username, "email" => $email, "password" => $password, "watched" => array(), "admin" => false);
        file_put_contents("data/usersDir/".$username.".json", json_encode($user, JSON_PRETTY_PRINT|JSON_FORCE_OBJECT));

        $_SESSION["user"] = $user;
        header("Location: index.php" );
        exit();

    }
}

?>