<?php
require "series.php";

session_start();

$series = getSeries();

if (!isset($_SESSION["user"])) {header("Location: index.php" ); exit();}

include("pageParts/header.php");


?>


<section>
    <article>
        <div class="wrapper">
            <?php foreach($series as $item) : if(array_key_exists($item["id"], $_SESSION["user"]["watched"])) :?>
                <a class="title" href="view.php?id=<?= $item["id"] ?>">
                    <img class="thumbnail" src="<?=$item["cover"] ?>" alt="" >
                    <span class="caption">
                        <?php empty($item["episodes"]) ? $airdate = "Not yet" : $airdate = end($item["episodes"])["date"] ?>
                        <?php echo $item["title"]."<br>".count($item["episodes"])." episodes"."<br>Last aired: ".$airdate?>
                    </span>
                </a>
            <?php endif; endforeach; ?>
        </div>
    </article>
</section>



<?php include("pageParts/footer.php"); ?>

