<?php 
    require('./config/config.php');
    if (isset($_POST['submit'])) {
        $set_name = htmlspecialchars($_POST['set_name']);
        if (!empty($set_name)) {
            $sql = "INSERT INTO flashcard_set(set_name) VALUES(?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$set_name]);

            $sql ="CREATE TABLE `$set_name`(
                card_id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                question VARCHAR( 150 ) NOT NULL, 
                answer VARCHAR( 150 ) NOT NULL);" ;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            header('Location: ' . 'index.php' . '');
        } else {
            echo "ENTER A SET NAME";
        }
    }
?>

<?php include('./inc/header.php'); ?>

    <h1>Make New Set</h1>
    <div class="container">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form">
            <div class="form-group">
                <label for="user_set_name">Set Name</label>
                <input type="text" name="set_name" id="user_set_name" class="form-control">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

<?php include('./inc/footer.php'); ?>