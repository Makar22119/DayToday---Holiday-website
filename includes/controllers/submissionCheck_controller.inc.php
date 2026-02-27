<?php
declare(strict_types = 1);

function isPermissionGranted(object $pdo, int $userId){
    return isset(json_decode(checkUserRoles($pdo, $userId)[0]['roles'], true)['admin']);
}