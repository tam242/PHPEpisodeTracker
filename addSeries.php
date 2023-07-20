<?php
require "series.php";

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != true) {
    header("Location: index.php" );
    exit();
}

$error = addSeries();

include("pageParts/header.php");


?>


<section>
    <article>
        <div class="wrapper">
            <div class="formContainer">
                <form method="post" novalidate>
                    <h3>Release date (year)</h3>
                    <input name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>">
                    <h3>Title</h3>
                    <input name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                    <h3>Plot</h3>
                    <textarea name="plot"><?php echo isset($_POST['plot']) ? $_POST['plot'] : '' ?></textarea>
                    <h3>Cover image (link)</h3>
                    <input name="cover" value="<?php echo isset($_POST['cover']) ? $_POST['cover'] : '' ?>">
                    <?php if(isset($error)) { echo $error; }?>
                    <input type="submit" class="formButton" name="addSeries" value="Add Series"/>
                </form>
            </div>
        </div>
    </article>
</section>



<?php include("pageParts/footer.php"); ?>
