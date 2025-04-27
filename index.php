<?php
echo "This is a my small project" . '<br>';
?> 
<?php require 'components/header.php';?>
<?php
    $name = $email = $body = '';
    $name_err = $email_err = $body_err  = '';

    if(isset($_POST['submit'])) {
        //validations
        if(empty($_POST['name'])) {
            $name_err = 'Name is required';
        } else {
            $name = htmlspecialchars($_POST['name']);
        }
        if(empty($_POST['email'])) {
            $email_err = 'Email is required';
        } else {
            $email = htmlspecialchars($_POST['email']);
        }
        if(empty($_POST['body'])) {
            $body_err = 'Body is required';
        } else {
            $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        $validate_sucess = empty($name_err) && empty($email_err)  && empty($body_err);
        try{
            if($validate_sucess) {
                $sql = "INSERT INTO feedback(name, email, body) VALUES (?,?,?)";
                $statement = $connection->prepare($sql);
                $statement->bindParam(1, $name);
                $statement->bindParam(2, $email);
                $statement->bindParam(3, $body);
                $statement->execute();
                echo '<h3 class="text-success">Insert feedback Successfully!</h3>';

                echo '<a href="feedback_list.php">Click here to redirect list feedback</a>';
                //header("Location: feedback_list.php");
            }
        }catch(PDOException $e) {
            echo "Cannot insert" . $e->getMessage();
        }
        
    }
?>


<body>
    <h1>Enter your feedback here</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <div class="mb-3">
            <input type="text" name="name" class="form-control <?php echo $name_err ? 'is-invalid' : '';?>" placeholder="What is your name ?">
            <p class="text-danger"><?php echo $name_err?></p>
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="form-control <?php echo $email_err ? 'is-invalid' : '';?>" placeholder="Enter your email">
            <p class="text-danger"><?php echo $email_err?></p>
        </div>

        <div class="mb-3">
            <textarea class="form-control <?php echo $body_err ? 'is-invalid' : '';?>" name="body" placeholder="Enter your feedback" rows="2"></textarea>
            <p class="text-danger"><?php echo $body_err?></p>
        </div>

        <div class="mb-3">
            <input type="submit" class="btn btn-primary" name="submit" value="Send">
        </div>
    </form>
    <?php include 'components/footer.php';?>
</body>
</html>