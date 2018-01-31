<?php
    require('config/config.php');
    require('config/query.php');
    $stmt = $pdo->query("SELECT * FROM `$setName`");
    $cards = $stmt->fetchAll();
    
?>

<?php include('./inc/header.php'); ?>
    <div class="text-center mt-2 mb-3">
        <h1 class="set-title">
            <?php echo $setName; ?>
        </h1>
        
        <!-- Empty Fields Message -->
        <?php if (isset($_GET['fields'])):  ?>
            <div class="alert alert-danger">
                <span>Please fill in all fields.</span>
            </div>
        <?php endif; ?>
        <!-- /Empty Fields Message -->

        <!-- Edit Set Name Form -->
        
        <?php include('inc/forms/set-name.form.php'); ?>

        <!-- /Edit Set Name Form -->

        <button type="button" class="show-form btn btn-outline-secondary mt-3">Edit Set Name</button>
    </div>

    <!-- Cards -->
    <div class="cards">
        <?php foreach($cards as $card): ?>
        <div class="card show_answer">
            <div class="card__edit">
                <button class="btn btn-light" type="button">Edit</button>
            </div>
            <div class="card-body">
                <p class="card-text question"><?php echo $card['question']; ?></p>
                <p class="card-text answer"><?php echo $card['answer']; ?></p>
            </div>
        </div>
        <div class="card edit-card">
            <?php include('inc/forms/edit-card.form.php'); ?>
        </div>
        <?php endforeach; ?>
        <div class="card add-card text-muted">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add Card
        </div>
        

        <!-- Add Card Form -->

        <?php include('inc/forms/add-card.form.php'); ?>

        <!-- /Add Card Form -->

    </div>
    <!-- /Cards -->
    <div class="my-3">
        <?php include('./inc/modal.php'); ?>
    </div>

<?php include('./inc/footer.php'); ?>