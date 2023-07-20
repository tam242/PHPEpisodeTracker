<?php


function getSeries() {
    return json_decode(file_get_contents("data/series.json"), true);
}

function getSeriesById($id) {
    $series = getSeries();
    foreach ($series as $item) {
        if ($item["id"] == $id) {
            return $item;
        }
    }
    return null;
}

function addSeries() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST["date"];
        $title = $_POST["title"];
        $plot = $_POST["plot"];
        $cover = $_POST["cover"];

        if (strlen(trim($date)) == 0 || strlen(trim($title)) == 0 || strlen(trim($plot)) == 0 || strlen(trim($cover)) == 0) {
            return "<div class='errorMessage'>Please fill all fields</div>";
        }
        if ($date < 1900 || $date > 2115) {
            return "<div class='errorMessage'>Invalid release date</div>";
        }
        
        $allSeries = getSeries();
        $id = count($allSeries)+1;
        $series = array("id" => $id, "year" => (int)$date, "title" => $title, "plot" => $plot, "cover" => $cover, "episodes" => array());
        array_push($allSeries, $series);

        file_put_contents("data/series.json", json_encode($allSeries, JSON_PRETTY_PRINT|JSON_FORCE_OBJECT));
        header("Location:view.php?id=".$id);
        exit();
    }
}

function addEpisode() {
    if (isset($_POST["addEpisode"])) {
        $title = $_POST["title"];
        $aired = $_POST["aired"];
        $plot = $_POST["plot"];
        $rating = $_POST["rating"];
        $id = $_GET["id"];

        if (strlen(trim($title)) == 0 || strlen(trim($aired)) == 0 || strlen(trim($plot)) == 0 || strlen(trim($rating)) == 0) {
            return "<div class='errorMessage'>Please fill all fields</div>";
        }
        if ($rating < 1 || $rating > 10) {
            return "<div class='errorMessage'>Rating has to be between 1 and 10</div>";
        }

        $allSeries = getSeries();
        $series = getSeriesById($id);
        $newid = count($series["episodes"])+1;
        $episode = array("id" => $newid, "date" => $aired, "title" => $title, "plot" => $plot, "rating" => (float)$rating);
        array_push($series["episodes"], $episode);
        $allSeries[$id] = $series;

        file_put_contents("data/series.json", json_encode($allSeries, JSON_PRETTY_PRINT|JSON_FORCE_OBJECT));
    }
    
}

?>