<?php 
require "users.php";

session_start();

include("pageParts/header.php"); ?>


<section>
    <article>
        <div class="wrapper">
        <div class="container">
                <form method="post">
                    <input type="submit" class="logout" name="confirmLogout" value="Confirm logout" style="margin: 0;"/>
                </form>
        </div>
        </div>
    </article>
</section>


<?php include("pageParts/footer.php"); ?>

<?php 
    if(isset($_POST['confirmLogout'])) {
        logout();
    }
?>