<?php
require "users.php";

session_start();

include("pageParts/header.php");

$error = createUser();

?>


<section>
    <article>
        <div class="loginContainer">
            <a class="loginTitle">Sign up</a>
            <form method="POST" novalidate>
                <input placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <input placeholder="Username" name="uName" value="<?php echo isset($_POST['uName']) ? $_POST['uName'] : '' ?>">
                <input type="password" placeholder="Password" name="passW">
                <input type="password" placeholder="Confirm Password" name="passWC">
                <?php if(isset($error)) { echo $error; }?>
                <button class="signup" type="submit" name="submit">Sign up</button>
            </form>
        </div>
    </article>
</section>


<?php include("pageParts/footer.php"); ?>

