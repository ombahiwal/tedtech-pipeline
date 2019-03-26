<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Add Project</h2>
  <form method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
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
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'skill_name' => $row['skill_name'] 
            ];
        }
    var_dump($stocks);
    
}
?>