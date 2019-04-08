
<form method="GET">
<input type="text" name="search_query">
<input type="submit" value="search">
</form>


<?php

function clean($string){
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}


if(isset($_GET['search_query'])){
    $query_string = clean($_GET['search_query']);
    // replace table name and column names to get the desired output
    $table_name = "skill_table";
    $column_name = "skill_name";
    $fetch_column_name = "*";
    // Limit of the output
    $limit = "5";
    // Connection file 
    require('../connections/db_connection_root.php');
    $sqlQuery = "SELECT {$fetch_column_name} FROM {$table_name} WHERE LOWER({$column_name}) LIKE LOWER('{$query_string}%') LIMIT {$limit}";
$stmt =  $dbcon_pdo->query($sqlQuery);
    
     $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'skill_name' => $row['skill_name'] 
            ];
        }
    var_dump($stocks);
    
}
?>