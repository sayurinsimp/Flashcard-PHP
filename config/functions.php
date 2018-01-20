<?php
function prepareAndExecute($sql, $statements, $fetchType = '') {
    require('./config/config.php');
    $stmt = $pdo->prepare($sql);
    $stmt->execute($statements);
    if ($fetchType === 'fetch') {
        return $stmt->fetch();
    } else if ($fetchType === 'fetchAll') {
        return $stmt->fetchAll();
    } else {
        ;
    }
}