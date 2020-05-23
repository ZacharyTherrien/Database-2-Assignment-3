<?php
require_once('database.controller.php');
$sort = "";
$numFilters = 0;
$filter = "";
$query = "";
$nameFilter = $_GET['name'];
$priceFilter = $_GET['price'];
$ratingFilter = $_GET['rating'];
echo "PRICE: ".$priceFilter;
if(!empty($nameFilter)){
    $filter = " WHERE `name` = '$nameFilter'";
    $numFilters++;
}
if(!empty($priceFilter)){
    if($numFilters > 0){
        $filter .= " AND `price` <= '$priceFilter'";   
        $numFilters++;
    }
    else{
        $filter = " WHERE `price` <= '$priceFilter'";
        $numFilters++;
    }
}
if(!empty($ratingFilter)){
    if($numFilters > 0){
        $filter .= " AND `rating` >= '$ratingFilter'";
    }
    else{
        $filter = " WHERE `rating` >= '$ratingFilter'";
    }
}
if($_GET['sort'] != "None"){
    $sort = " ORDER BY ".$_GET['sort'];
}
$query =    "SELECT `id`, `name`, `series`, AVG(`r`.`rating`) FROM `product` AS `p`
            LEFT OUTER JOIN `review` AS `r` ON `p`.`id` = `r`.`product_id`";
$query .= $filter;
$query .= " GROUP BY `id`";
$query .= $sort;
$query .= " UNION ";
$query .=   "SELECT `id`, `name`, `series`, AVG(`r`.`rating`) FROM `product` AS `p`
            RIGHT OUTER JOIN `review` AS `r` ON `p`.`id` = `r`.`product_id`";
$query .= $filter;
$query .= " GROUP BY `id`";
$query .= $sort;
echo ($query);
$statement = $connection->prepare($query);
$statement->execute();
if($statement){
    echo "LET'S GOOOOOOOOOOOOOOOOOOOOOOOOOOO!!";
}
$statement->bind_result($id, $name, $series, $rating);
$products = [];
for($i = 0; $statement->fetch(); $i++){
    $products[$i] = ['id' => $id, 'name' => $name, 'series' => $series, 'rating' => $rating];
}