<?php
require "series.php";

session_start();

$series = getSeries();

include("pageParts/header.php");


?>


<section>
    <article>
        <div class="wrapper">
            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] === true) : ?>
                <a class="title" href="addSeries.php">
                    <img class="thumbnail" src="images/addnewButton.png" alt="" style="opacity: 0.7;">
                    <span class="caption">
                        Add new series
                    </span>
                </a>
            <?php endif ?>

            <?php foreach($series as $item) :?>
                <a class="title" href="view.php?id=<?= $item["id"] ?>">
                    <img class="thumbnail" src="<?=$item["cover"] ?>" alt="" >
                    <span class="caption">
                        <?php empty($item["episodes"]) ? $airdate = "Not yet" : $airdate = end($item["episodes"])["date"] ?>
                        <?php echo $item["title"]."<br>".count($item["episodes"])." episodes"."<br>Last aired: ".$airdate?>
                    </span>
                </a>
            <?php endforeach ?>
        </div>
    </article>
</section>



<?php include("pageParts/footer.php"); ?>

