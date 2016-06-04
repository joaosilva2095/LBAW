<?php 
function get_all_mercha()
{
    global $conn;
    $stmt = $conn->prepare("SELECT mercha_products.id, mercha_products.description, mercha_products.price, mercha_categories.name
                            FROM mercha_products,mercha_categories WHERE  mercha_products.category= mercha_categories
                            .id  ORDER BY mercha_products.id ASC ");
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
                            WHERE id = ? ");
    return $stmt->execute(array($mercha_id));
}

function getAllCategories(){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM mercha_categories");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCategoryId($category){
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM mercha_categories WHERE name=?");
    $stmt->execute(array($category));
    return $stmt->fetchAll();
}

function addMercha($category,$description,$price){
    global $conn;

    $categoryId=getCategoryId($category)[0]['id'];

    $stmt = $conn->prepare("INSERT INTO mercha_products (category, description, price)
                            VALUES (?, ?, ?)  RETURNING id");
    if (!$stmt->execute(array($categoryId, $description, $price))) {
        return false;
    };
    return $stmt->fetch();
}

function editMercha($id,$category,$description,$price){
    global $conn;

    $categoryId=getCategoryId($category)[0]['id'];

    $stmt = $conn->prepare("UPDATE mercha_products SET
                            category = ?, price = ?,description = ?
                            WHERE id = ?");
    return $stmt->execute(array($categoryId,$price,$description,$id));
}

function newCategory($name){
    global $conn;

    $stmt = $conn->prepare("INSERT INTO mercha_categories (name)
                            VALUES (?)  RETURNING id");
    if (!$stmt->execute(array($name))) {
        return false;
    };
    return $stmt->fetch();
}

function delCategory($name){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM mercha_categories WHERE name =?");
    return $stmt->execute(array($name));
}

?>
