<?php
    require('config/config.php');
    require('config/query.php');
    $stmt = $pdo->query("SELECT * FROM `$setName`");
    $cards = $stmt->fetchAll();

    $msg = '';
    if (isset($_GET['fields'])) {
        $msg = "Please fill in all fields.";
    }
    
?>

<?php include('./inc/header.php'); ?>
    <div class="text-center mt-2 mb-3">
        <h1 class="set-title">
            <?php echo $setName; ?>
        </h1>
        <?php if ($msg != ''):  ?>
            <div class="alert alert-danger"><?php echo $msg; ?></div>
        <?php endif; ?>
        <!-- Edit set form -->
        <form 
            method="POST" 
            action="config/set.config.php?set_id=<?php echo $set_id; ?>" 
            class="form add-set-form">
            <div class="form-group mt-3">
                <label for="user_set_name">Set Name</label>
                <input value="<?php echo $setName; ?>" type="text" name="set_name" id="user_set_name" class="form-control">
            </div>
            <input type="submit" name="submit_set_name" value="Submit" class="btn btn-primary">
            <button type="button" class="btn btn-secondary form-cancel">Cancel</button>
        </form>
        <!-- /Edit set form -->
        <button type="button" class="show-form btn btn-outline-secondary mt-3">Edit Set Name</button>
    </div>
    <div class="cards">
        <?php foreach($cards as $card): ?>
        <div class="card show_answer">
            <div class="card__edit">
                <a href="add-edit.php?set_id=<?php echo $set_id; ?>&amp;card_id=<?php echo $card['card_id']; ?>">Edit</a>
            </div>
            <div class="card-body">
                <p class="card-text question"><?php echo $card['question']; ?></p>
                <p class="card-text answer"><?php echo $card['answer']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="card add-card text-muted">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add Card
        </div>
        <div class="container">
        <form 
            class="form card add-card-form container pt-2 pb-2" 
            method="POST" 
            action="config/set.config.php?set_id=<?php echo $set_id; ?>" 
            class="form">
            <div class="form-group">
                <label for="user_question">Question</label>
                <input type="text" name="question" id="user_question" class="form-control">
            </div>
            <div class="form-group">
                <label for="user_answer">Answer</label>
                <input type="text" name="answer" id="user_answer" class="form-control">
            </div>
            <input type="submit" name="submit_card" value="submit" class="btn btn-primary">
            <button class="btn btn-secondary form-cancel" type="button">Cancel</button>
        </form>
        </div>
    </div>
    <div class="my-3">
        <?php include('./inc/modal.php'); ?>
    </div>

<?php include('./inc/footer.php'); ?>