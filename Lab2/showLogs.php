
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Logs</title>
</head>
<body>
    <?php
        require __DIR__ . '/vendor/autoload.php';

        if (file_exists(FILE_PATH)) {
            $file = file_get_contents(FILE_PATH);
        }

        $file_lines = explode(PHP_EOL, $file);
        foreach ($file_lines as $line) {
            if (!empty($line)) {
                $words = explode(",", $line);
                echo <<< "showDetails"
                    <section>
                        <h2>User Details</h2>
                        <p>Visit Date: {$words[0]}</p>
                        <p>IP Address: {$words[1]}</p>
                        <p>Email: {$words[2]}</p>
                        <p>Name: {$words[3]}</p>
                    </section>
                    <hr>
                showDetails;
            }
        }

    ?>
</body>
</html>