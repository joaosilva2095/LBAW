<?php 
function get_all_mercha()
{
    global $conn;
    $stmt = $conn->prepare("SELECT mercha_products.id, mercha_products.description, mercha_products.price, mercha_categories.name
                            FROM mercha_products,mercha_categories WHERE  mercha_products.category= mercha_categories.id");
    $stmt->execute();
    return $stmt->fetchAll();
}



/**
 *  Remove a mercha product from the database
 *
 * @param $mercha_id id of the user to remove
 * @return true if successfull, false otherwise
 */
function remove_mercha($mercha_id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM mercha_products
                            WHERE id = ?");
    return $stmt->execute(array($mercha_id));
}

?>