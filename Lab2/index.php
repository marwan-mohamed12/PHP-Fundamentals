<?php
require __DIR__ . '/vendor/autoload.php';
?>

<html>

<head>
    <title> contact form </title>
    <style>
        span {
            color: red;
        }
    </style>
</head>

<body>

<?php

    $nameErr = $emailErr  = $messageErr = "";
    $name = $email = $message = "";
    $submitted = false;
    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        if (empty($_POST['name'])) {
            $nameErr = "Name is required";
        } else {
            $name = clean_input($_POST["name"]);
            if (checkLength(NAME_LENGTH, $name)) {
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameErr = "Only letters and white space allowed";
                }
            } else {
                $nameErr = "Name Should be less than " . NAME_LENGTH . "characters";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = clean_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
        } else {
            $message = clean_input($_POST["message"]);
            if (!checkLength(MESSAGE_MAX_LENGTH, $message)) {
                $messageErr = "Message should be less than " . MESSAGE_MAX_LENGTH . "characters";
            }
        }

        if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
            $submitted = true;
        }
    }

?>


    <h3> Contact Form </h3>
    <div id="after_submit">

    </div>
    <form id="contact_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

        <div class="row">
            <label class="required" for="name">Your name:</label><br />
            <input id="name" class="input" name="name" type="text" value="<?php echo $name; ?>" size="30" />
            <span><?php echo $nameErr;  ?></span><br />

        </div>
        <div class="row">
            <label class="required" for="email">Your email:</label><br />
            <input id="email" class="input" name="email" type="text" value="<?php echo $email; ?>" size="30" />
            <span><?php echo $emailErr;  ?></span><br />

        </div>
        <div class="row">
            <label class="required" for="message">Your message:</label><br />
            <textarea id="message" class="input" name="message" rows="7" cols="30"><?php echo $message; ?></textarea>
            <span><?php echo $messageErr;  ?></span><br />

        </div>

        <input id="submit" name="submit" type="submit" value="Send email" />
        <input id="clear" name="clear" type="reset" value="clear form"/>

    </form>

    <?php 

        if ($submitted) {

            $logMessage = date("F j Y g:i a").",{$_SERVER['REMOTE_ADDR']},$name,$email".PHP_EOL;
            file_put_contents(FILE_PATH, $logMessage, FILE_APPEND | LOCK_EX);

            echo "<h2>".WELCOME_MESSAGE."</h2>";
            echo <<< "WelcomeMessage"
                <p>Name: $name</p>
                <p>Email: $email</p>
                <p>Message: $message</p>
            WelcomeMessage;

        }

    ?>

</body>

</html>