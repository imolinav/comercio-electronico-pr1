<?php
if (isset($_GET['header'])) {
    require_once(__DIR__.'/../../database.php');
    $products = getProducts($connection, $_GET);
    if (empty($products)) {
        $response = array('status' => 'error', 'message' => 'Products not found');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success', 'message' => 'Products found', 'data' => $products);
        echo json_encode($response);
    }
} else {
    if (isset($_GET['text'])) {
        require_once(__DIR__.'/../../database.php');
        $products = getProducts($connection, $_GET);
        $companies = array_unique(array_map(function($elem) {return $elem['company'];}, $products));
        $types = array_unique(array_map(function($elem) {return $elem['type'];}, $products));
    }
    
    include 'pages/shared/header/header.view.phtml';
    include 'pages/search/search.view.phtml';
    include 'pages/shared/footer/footer.view.phtml';
}

function getProducts($connection, $filters) {
    $stmt = mysqli_prepare($connection, "SELECT p.name, p.price, p.offer, p.description, c.name as company, c.id as company_id, t.type, t.id as type_id, COALESCE(AVG(r.rating), 0) as rating, LOWER(REPLACE(p.name, ' ', '-')) as link FROM company c, product_type t, product_has_type h, product p LEFT JOIN product_ratings r ON p.id = r.product_id WHERE p.name LIKE ? AND p.company_id = c.id AND h.product_id = p.id AND h.type_id = t.id GROUP BY p.name ORDER BY p.id");
    $queryText = '%' . $filters['text'] . '%';
    mysqli_stmt_bind_param($stmt, "s", $queryText);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    return $result;
}

?>