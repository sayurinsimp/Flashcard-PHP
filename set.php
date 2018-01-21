<?php
    require('./config/config.php');
    require('./config/query.php');

    // Get flashcard info
    $stmt = $pdo->query("SELECT * FROM `$setName`");
    $cards = $stmt->fetchAll();
?>

<?php include('./inc/header.php'); ?>
    <div class="text-center mt-2 mb-3">
        <h1 class="set-title">
            <?php echo $setName; ?>
        </h1>
        <a href="new-set.php?set_id=<?php echo $set_id; ?>" class="add-btn btn btn-outline-secondary mt-3">Edit Set Name</a>
    </div>
    <div class="cards">
        <?php foreach($cards as $card): ?>
        <div class="card">
            <div class="card__edit">
                <a href="add-edit.php?set_id=<?php echo $set_id; ?>&amp;card_id=<?php echo $card['card_id']; ?>">Edit</a>
            </div>
            <div class="card-body text-center">
                <p class="card-text question"><?php echo $card['question']; ?></p>
                <p class="card-text answer"><?php echo $card['answer']; ?></p>
                <button type="button" class="btn btn-primary card__btn">Show Answer</button>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="card add-card">
            <a href="add-edit.php?set_id=<?php echo $set_id; ?>" class="add-btn btn btn-secondary">Add Card</a>
        </div>
    </div>
    <div class="my-3">
        <?php include('./inc/modal.php'); ?>
    </div>

<?php include('./inc/footer.php'); ?>