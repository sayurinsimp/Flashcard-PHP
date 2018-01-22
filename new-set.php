<?php 
    require('./config/config.php');
    require('./config/functions.php');
    $pageTitle = "Make New Set";
    $href = "index.php";
    $msg = '';

    // If set_id exist, set name is being edited
    if (isset($_GET['set_id'])) {
        require('./config/query.php');
        $pageTitle = 'Edit Set Name';
        $href = "set.php?set_id=$set_id";
    }
    
    if (isset($_POST['submit'])) {
        $posted_set_name = htmlspecialchars($_POST['set_name']);
        if (!empty($posted_set_name)) {
            // Card Set is being edited
            if (isset($_GET['set_id'])) {
                $sql = "RENAME TABLE `$setName` TO `$posted_set_name`";
                prepareAndExecute($sql, array());

                $sql = "UPDATE flashcard_set SET set_name = ? WHERE set_id = ?";
                prepareAndExecute($sql, array($posted_set_name, $set_id));
                header('Location: ' . 'index.php' . '');


            } 
            // This is a new card set
            else { 
                $sql = "INSERT INTO flashcard_set(set_name) VALUES(?)";
                prepareAndExecute($sql, array($posted_set_name));

                $sql ="CREATE TABLE `$posted_set_name`(
                card_id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                question VARCHAR( 150 ) NOT NULL, 
                answer VARCHAR( 150 ) NOT NULL);";
                prepareAndExecute($sql, array());
                header('Location: ' . 'index.php' . '');
            }
            
        } else {
            $msg = 'Please fill in all fields';
        }
    }
?>

<?php include('./inc/header.php'); ?>

    <h1 class="text-center"><?php echo $pageTitle ?></h1>
    <?php if ($msg != ''):  ?>
        <div class="alert alert-danger"><?php echo $msg; ?></div>
    <?php endif; ?>
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