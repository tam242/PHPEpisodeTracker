<?php
require "users.php";
require "series.php";

session_start();

include("pageParts/header.php");

$seriesId = $_GET["id"];
$series = getSeriesById($seriesId);

changeWatched($seriesId);


?>
<section>
    <article>
        <div class="wrapper">
            <?php if ($series !== null) : ?>
            <table>
                <tr>
                    <td valign="top">
                        <a class="title" href="<?= $series["cover"] ?>" target="_blank" style="vertical-align:top;">
                            <img class="fullerSize" src="<?=$series["cover"] ?>" alt="">
                            <span class="caption"><?=$series["title"] ?></span>
                        </a>
                    </td>
                    <td>
                        <div class="description">

                            <p>
                                Released: <?= $series["year"]?> <br>
                                Plot: <?= $series["plot"]?>
                            </p>
                            Episodes: <?= count($series["episodes"]) ?>
                            <?php if (isset($_SESSION["user"])) : ?>
                                | Seen:
                                <form method="post" style="display: inline-block;">
                                    <input name="epCount" class="epCount" placeholder="<?php echo getEpsWatched($seriesId, $_SESSION["user"]);?>">
                                    <input type="submit" class="formButton" name="watch" value="Watch"/>
                                </form>
                            <?php endif ?>

                            <p>Episode list:</p>
                            <?php foreach($series["episodes"] as $episode) : ?>
                                <p <?php if (isset($_SESSION["user"])) {if ($episode['id'] <= getEpsWatched($seriesId, $_SESSION["user"])) {echo "class='seenEp'";}} ?>>
                                    Title: <?= $episode["title"] ?> <br>
                                    Aired: <?= $episode["date"] ?> <br>
                                    Plot: <?= $episode["plot"] ?> <br>
                                    Rating: <?= $episode["rating"] ?> <br>
                                </p>
                            <?php endforeach; ?>

                            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] === true) : $error = addEpisode();?>
                            <div class="addEpContainer" id="apc">
                                <form method="post" action="#apc;" novalidate>
                                    <h3>Title:</h3>
                                    <input name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                                    <h3>Aired:</h3> 
                                    <input name="aired" type="date" value="<?php echo isset($_POST['aired']) ? $_POST['aired'] : '' ?>">
                                    <h3>Plot:</h3> 
                                    <textarea name="plot"><?php echo isset($_POST['plot']) ? $_POST['plot'] : '' ?></textarea>
                                    <h3>Rating:</h3> 
                                    <input name="rating" value="<?php echo isset($_POST['rating']) ? $_POST['rating'] : '' ?>">
                                    <?php if(isset($error)) { echo $error; }?>
                                    <input type="submit" class="formButton" name="addEpisode" value="Add episode"/>
                                </form>
                            </div>
                            <?php endif; ?>

                        </div>
                    </td>
                </tr>
            </table>
            <?php else : header("Location: 404.php" ); exit(); endif; ?>
        </div>
    </article>
</section>


<?php include("pageParts/footer.php"); ?>

