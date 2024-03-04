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

    require_once ('config.php');

    // Define variables and set to empty values
    $nameErr = $emailErr  = $messageErr = "";
    $name = $email = $message = "";
    $submitted = false;

    // Function to sanitize input data
    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

    // Function to check length of inputs
    function checkLength($length, $str)
    {
        return strlen($str) < $length;
    }

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // Validate name
        if (empty($_POST['name'])) {
            $nameErr = "Name is required";
        } else {
            $name = sanitize_input($_POST["name"]);
            if (checkLength(nameLength, $name)) {
                // Check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameErr = "Only letters and white space allowed";
                }
            } else {
                $nameErr = "Name Should be less than " . nameLength . "characters";
            }
        }

        // Validate email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = sanitize_input($_POST["email"]);
            // Check if email address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate message
        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
        } else {
            $message = sanitize_input($_POST["message"]);
            // Check The Length Of The Message
            if (!checkLength(messageMaxLength, $message)) {
                $messageErr = "Message should be less than " . messageMaxLength . "characters";
            }
        }

        // Check if form data is valid
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
            echo "<h2>".WelcomeMessage."</h2>";
            echo <<< "WelcomeMessage"
                <p>Name: $name</p>
                <p>Email: $email</p>
                <p>Message: $message</p>
            WelcomeMessage;
        }

    ?>

</body>

</html>