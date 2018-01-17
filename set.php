<?php
    require('./config/config.php');
    require('./config/query.php');

    // Get flashcard info
    $sql = "SELECT * FROM `$setName`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$setName]);
    $cards = $stmt->fetchAll();
?>

<?php include('./inc/header.php'); ?>
    <div class="container">
        <h1 class="title">Viewing <span><?php echo $setName; ?><span> Set</h1>
        <div class="cards">
            <?php foreach($cards as $card): ?>
            <div class="card">
                <div class="card__delete">
                    <a href="edit.php?card_id=<?php echo $card['card_id']; ?>">Edit</a>
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
            <a href="add.php?set_id=<?php echo $id; ?>" class="add-btn btn btn-secondary">Add Card</a>
        </div>
    </div>

<?php include('./inc/footer.php'); ?>