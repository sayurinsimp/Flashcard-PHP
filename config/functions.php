<?php
/**
 * Perform prepare() and execute()
 * $fetchType can equal 'fetch' or 'fetchAll''
 * 'fetch' returns array with single item
 * 'fetchAll' returns array with multiple items
 *  if no fetch type, nothing is returned
 */
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