        
  <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utc-8">
        <link href="index.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.html">QuestionForm</a></li>
            </ul>
        </nav>
        <?php
            require('database.php');
            $name = $_POST('name');
            $email = $_POST('email');
            $question = $_POST('question');

            $name_input = set_string($db_connect, $name);
            $email_input = set_string($db_connect, $email);
            $question_input = set_string($db_connect, $question);

            $s = "INSERT INTO UserQuestions(firstname, email, question) VALUES (?,?,?)";

            $user_question_input = mysqli_prepare($db_connect, $s);

            mysqli_stmt_bind_param(
                $user_question_input,
                'sss',
                $name_input,
                $email_input,
                $question_input
            );

            $input = mysqli_stmt_execute($user_question_input);
            if ($input) {
                echo "<p>Your data is submitted $name.</p>";
                echo "<p>You'll be sent an email with Floyd's answer, at the email you listed: $email</p>";
            }
            else {
                echo "<p>500. Internal error. Please try again later.</p>";
            }
        ?>
    </body>
</html>      