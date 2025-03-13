<?php
function generateUniqueId($prefix = '') {
    $uniqueId = uniqid(); 

    $id = $prefix . substr($uniqueId, 0, 20 - strlen($prefix)); 
    return $id;
}
?>