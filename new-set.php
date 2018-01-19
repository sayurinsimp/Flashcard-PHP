<?php 
    require('./config/config.php');
    $pageTitle = "Make New Set";
    $href = "index.php";
    // If set_id exist, set name is being edited
    if (isset($_GET['set_id'])) {
        require('./config/query.php');
        $pageTitle = 'Edit Set Name';
        $href = "set.php?set_id=$set_id";
    }
    
    if (isset($_POST['submit'])) {
        $posted_set_name = htmlspecialchars($_POST['set_name']);
        if (!empty($posted_set_name)) {
            if (isset($_GET['set_id'])) {
                $sql = "RENAME TABLE `$setName` TO `$posted_set_name`";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $sql = "UPDATE flashcard_set SET set_name = ? WHERE set_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$posted_set_name, $set_id]);
                header('Location: ' . 'index.php' . '');


            } else {
                $sql = "INSERT INTO flashcard_set(set_name) VALUES(?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$posted_set_name]);

                $sql ="CREATE TABLE `$posted_set_name`(
                card_id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                question VARCHAR( 150 ) NOT NULL, 
                answer VARCHAR( 150 ) NOT NULL);" ;
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                header('Location: ' . 'index.php' . '');
            }
            
        } else {
            echo "ENTER A SET NAME";
        }
    }
?>

<?php include('./inc/header.php'); ?>

    <h1 class="text-center"><?php echo $pageTitle ?></h1>
    <div class="container">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form">
            <div class="form-group">
                <label for="user_set_name">Set Name</label>
                <input value="<?php  echo isset($set_id) ? $setName : '' ?>" type="text" name="set_name" id="user_set_name" class="form-control">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <a class="btn btn-secondary" href="<?php echo $href; ?>">Cancel</a>
        </form>
    </div>

<?php include('./inc/footer.php'); ?>