<?php
require_once(__DIR__.'/../../database.php');

if (isset($_POST['add_product'])) {
    $data = json_decode($_POST['add_product'], true);
    
    $shoppingCart = addProductToShoppingCart($connection, $data['userId'], $data['product'], $data['quantity']);
    
    if(!isset($shoppingCart) || empty($shoppingCart)) {
        $response = array('status' => 'error', 'message' => 'Product couldn\t be added to shopping cart');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success', 'message' => 'Product added to the shopping cart', 'data' => $shoppingCart);
        echo json_encode($response);
    }

} else if (isset($_POST['remove_product'])) {

} else if (isset($_GET['user_id'])) {
    $shoppingCart = getShoppingCart($connection, $_GET['user_id']);
    if(!isset($shoppingCart) || empty($shoppingCart)) {
        $response = array('status' => 'error', 'message' => 'Product couldn\t be added to shopping cart');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success', 'message' => 'Product added to the shopping cart', 'data' => $shoppingCart);
        echo json_encode($response);
    }
} else {
    $productName = str_replace('-', ' ', $_SERVER['REQUEST_URI']);
    $productName = str_replace('/', '', $productName);
    
    $product = getProduct($connection, $productName);
    
    if (!empty($product)) {
        $sameTypeProducts = getSameTypeProducts($connection, $product['type_id'], $product['id']);
        $sameCompanyProducts = getSameCompanyProducts($connection, $product['company_id'], $product['id']);
    }
    
    include 'pages/shared/header/header.view.phtml';
    include 'pages/product/product.view.phtml';
    include 'pages/shared/footer/footer.view.phtml';
}

function getProduct($connection, $productName) {
    $stmt = mysqli_prepare($connection, "SELECT p.id, p.name, p.price, p.offer, p.description, c.name as company, c.id as company_id, t.type, t.id as type_id, COALESCE(AVG(r.rating), 0) as rating FROM company c, product_type t, product_has_type h, product p LEFT JOIN product_ratings r ON p.id = r.product_id WHERE p.name = ? AND p.company_id = c.id AND h.product_id = p.id AND h.type_id = t.id GROUP BY p.name");
    mysqli_stmt_bind_param($stmt, "s", $productName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    return $result;
}

function getSameTypeProducts($connection, $productType, $productId) {
    $stmt = mysqli_prepare($connection, "SELECT p.name, p.price, p.offer, p.description, c.name as company, c.id as company_id, t.type, t.id as type_id, COALESCE(AVG(r.rating), 0) as rating, LOWER(REPLACE(p.name, ' ', '-')) as link FROM company c, product_type t, product_has_type h, product p LEFT JOIN product_ratings r ON p.id = r.product_id WHERE t.id = ? AND p.id <> ? AND p.company_id = c.id AND h.product_id = p.id AND h.type_id = t.id GROUP BY p.name ORDER BY p.id LIMIT 4");
    mysqli_stmt_bind_param($stmt, "ii", $productType, $productId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    return $result;
}

function getSameCompanyProducts($connection, $productCompany, $productId) {
    $stmt = mysqli_prepare($connection, "SELECT p.name, p.price, p.offer, p.description, c.name as company, c.id as company_id, t.type, t.id as type_id, COALESCE(AVG(r.rating), 0) as rating, LOWER(REPLACE(p.name, ' ', '-')) as link FROM company c, product_type t, product_has_type h, product p LEFT JOIN product_ratings r ON p.id = r.product_id WHERE c.id = ? AND p.id <> ? AND p.company_id = c.id AND h.product_id = p.id AND h.type_id = t.id GROUP BY p.name ORDER BY p.id LIMIT 4");
    mysqli_stmt_bind_param($stmt, "ii", $productCompany, $productId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    return $result;
}

function getShoppingCart($connection, $userId) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM purchase WHERE `user_id` = ? AND `finished_at` IS NULL");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $shoppingCart = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!empty($shoppingCart) && isset($shoppingCart)) {
        $stmt_products = mysqli_prepare($connection, "SELECT COUNT(p.id) as quantity, p.id, p.name, p.price, p.offer, LOWER(REPLACE(p.name, ' ', '-')) as link FROM product p, purchase_has_product k WHERE p.id = k.product_id AND k.purchase_id = ? GROUP BY (p.id)");
        mysqli_stmt_bind_param($stmt_products, "i", $shoppingCart['id']);
        mysqli_stmt_execute($stmt_products);
        $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt_products), MYSQLI_ASSOC);
        $shoppingCart['products'] = $result;
    }
    return $shoppingCart;
}

function createShoppingCart($connection, $userId) {
    $stmt = mysqli_prepare($connection, "INSERT INTO purchase (`user_id`) VALUES (?)");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    return getShoppingCart($connection, $userId);
}

function addProductToShoppingCart($connection, $userId, $productId, $quantity) {
    $shoppingCart = getShoppingCart($connection, $userId);
    if (!isset($shoppingCart) || empty($shoppingCart)) {
        $shoppingCart = createShoppingCart($connection, $userId);
    }

    for ($i = 0; $i < $quantity; $i++) {
        $stmt = mysqli_prepare($connection, "INSERT INTO purchase_has_product (`purchase_id`, `product_id`) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ii", $shoppingCart['id'], $productId);
        mysqli_stmt_execute($stmt);
    }

    return getShoppingCart($connection, $userId);
}
?>