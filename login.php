<?php 
require "users.php";

session_start();

include("pageParts/header.php"); 

$error = loginAttempt();

?>


<section>
    <article>
        <div class="loginContainer">
            <a class="loginTitle">Login</a>
            <form method="POST" novalidate>
                <input placeholder="Username" name="uName" value="<?php echo isset($_POST['uName']) ? $_POST['uName'] : '' ?>">
                <input type="password" placeholder="Password" name="passW">
                <?php if(isset($error)) { echo $error; }?>
                <button class="signup" type="submit" name="submit">Login</button>
            </form>
        </div>
    </article>
</section>


<?php include("pageParts/footer.php"); ?>

