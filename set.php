<?php
    require('./config/config.php');
    require('./config/query.php');

    // Get flashcard info
    $stmt = $pdo->query("SELECT * FROM `$setName`");
    $cards = $stmt->fetchAll();
?>

<?php include('./inc/header.php'); ?>

    <h1 class="title">Viewing <span><?php echo $setName; ?></span> Set</h1>
    <div class="cards">
        <?php foreach($cards as $card): ?>
        <div class="card">
            <div class="card__edit">
                <a href="edit.php?set_id=<?php echo $set_id; ?>&amp;card_id=<?php echo $card['card_id']; ?>">Edit</a>
            </div>
            <div class="card-body text-center">
                <p class="card-text question"><?php echo $card['question']; ?></p>
                <p class="card-text answer"><?php echo $card['answer']; ?></p>
                <button type="button" class="btn btn-primary card__btn">Show Answer</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="my-3">
        <a href="add.php?set_id=<?php echo $set_id; ?>" class="add-btn btn btn-secondary">Add Card</a>
        <?php include('./inc/modal.php'); ?>
    </div>

<?php include('./inc/footer.php'); ?>