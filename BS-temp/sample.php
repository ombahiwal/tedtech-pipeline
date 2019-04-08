<!DOCTYPE html>
<html>
<?php
include('header.php');
?>
    <body>
        
        
        <!-- Projects Container start -->
         <div class="container">

    <div class="row">

      <div class="col-lg-3">
        <h4 class="my-4">Options</h4>
        <div class="list-group">
          <a href="#" class="list-group-item active">Quote</a>
          <a href="#" class="list-group-item">Report</a>
          <a href="#" class="list-group-item">Add to Wishlist</a>
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
          <div class="card-body">
            <h3 class="card-title">Genysis Network Analysis Tool</h3>
            <h4> <button type="button" class="btn btn-info">&#8377;24.99</button>
              </h4> 
            <p class="card-text"> A GUI based application which should show process ID and the connection which it is making, duly giving the location of each country. It should categorize display into commercial rootkits and others. The other rootkits may be shared with some standard repository like ‘Virustotal.com’ etc., to ascertain whether the process is malicious or safe. Accordingly, real-time white listing and blacklisting database may be built for users.</p>
<!--
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            4.0 stars
-->
          </div>
        </div>
        <!-- /.card -->

        <?php
          
          function clean($string){
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

          if(isset($_GET['pid'])){
    $query_string = clean($_GET['pid']);
    // replace table name and column names to get the desired output
    $table_name = "projects_table";
    $column_name = "project_id";
    $fetch_column_name = "*";
    // Limit of the output
    $limit = "5";
    // Connection file 
    require('../connections/db_connection_root.php');
    
    $sqlQuery = "SELECT * FROM {$table_name} WHERE LOWER({$column_name})={$query_string} LIMIT {$limit}";
$stmt =  $dbcon_pdo->query($sqlQuery);
    
     $stocks = [];
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'pname' => $row['project_name'] 
            ];
        }
    var_dump($stocks);
}
          ?>

      </div>
      <!-- /.col-lg-9 -->

    </div>

        </div>
        <!-- Container end -->
    </body>
    <?php include('footer.php'); ?>
    
</html>