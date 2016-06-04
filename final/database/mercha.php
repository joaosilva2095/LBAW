<?php 
function get_all_mercha()
{
    global $conn;
    $stmt = $conn->prepare("SELECT id, description, price, category
                            FROM mercha_products");
    $stmt->execute();
    return $stmt->fetchAll();
}
?>