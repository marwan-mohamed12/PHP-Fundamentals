<?php

require_once "vendor/autoload.php";

use App\DBhandler;

$dbConnect = new DBhandler();
$dbConnect->connect();

$page = isset($_GET["page"]) ? $_GET["page"] : 0;      
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["click"])) {
    if ($_GET["click"] == "prev") {
        if ($page > 0) {
            $page -= 5;
            if ($page < 0) $page = 0;
        }
    } else if ($_GET["click"] == "next") {
        $page += 5;
    }
} 

$itemsData = $dbConnect->get_data($page, ["id", "PRODUCT_code", "product_name"]);

var_dump($_POST);

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"]) && isset($_POST["colName"]) && isset($_POST["value"])) {
        $itemsData = $dbConnect->search_by_column($_POST["colName"], $_POST["value"]);
        echo $itemsData;
    }
} catch (\Exception $e) {
    echo " <div class='mess'>".$e->getMessage()."</div>";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container pt-4">
        <form class="d-flex" role="search" method="POST">
            <input class="form-control me-2" name="colName" type="text" placeholder="Column Name" aria-label="Search">
            <input class="form-control me-2" name="value" type="text" placeholder="Value" aria-label="Search">
            <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
        </form>
        <br>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php

            foreach ($itemsData as $item) {
                echo <<<"card"
                    <div class="col">
                        <div class="card">
                            <img src="images/{$item->Photo}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{$item->product_name}</h5>
                                <p class="card-text">ID: {$item->id}</p>
                                <p class="card-text">Units in stock: {$item->Units_In_Stock}</p>
                            </div>
                        </div>
                    </div>
                card;
            }

            ?>
        </div>
        <br>
        <nav aria-label="..." class="d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item ">
                    <?php
                        echo <<<"navigateLink"
                            <a href="?click=prev&page=$page" class="page-link">Previous</a>
                        navigateLink;
                    ?>
                </li>
                <li class="page-item">
                    <?php
                        echo <<<"navigateLink"
                            <a href="?click=next&page=$page" class="page-link">Next</a>
                        navigateLink;
                    ?>
                    
                </li>
            </ul>
        </nav>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>