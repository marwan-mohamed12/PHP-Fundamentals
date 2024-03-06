<?php

require_once "vendor/autoload.php";

use App\Items;

$itemsData = Items::skip(0)->take(5)->get();
// print_r($itemsData);

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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

