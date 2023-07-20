<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="styles.css">
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>
<body>
    <header>
        <a class="logo" href="index.php"><img class="logo" src="images/logo.png" alt="logo"></a>
        <nav>
            <ul class="navLinks">
                <li><a href="index.php" class="link">Home</a></li>

                <?php if (isset($_SESSION["user"])) : ?>
                    <li><a href="profile.php" class="link">Profile</a></li>
                <?php endif; ?>

                <li><a href="#" class="link">Search</a></li>

                <?php if (!isset($_SESSION["user"])) : ?>
                    <li><a href="login.php" class="link login">Login</a></li>
                    <li><a href="signup.php" class="link signup">Sign up</a></li>
                <?php else : ?>
                    <li><a href="logout.php" class="link logout">Log out</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>
