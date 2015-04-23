

<!DOCTYPE html>
<!------------------------------------------------------------------------------------------------ #
/ program: outdex.php
/ author:  Rashed Aldubayyan
/ course:  cis355 Winter 2015
/ purpose:  this file updates the tables  from the user 
/ ------------------------------------------------------------------------------------------------ #
/ input:   $_POST, or nothing
/
/				  displayHTMLHead
/               
/
/ output:  HTML, CSS, JavaScript code 
/ ------------------------------------------------------------------------------------------------ #
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Movies List</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Create</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Year</th>
                          <th>Genre</th>
                          <th>Name</th>
						  <th>Director</th>
                          <th>Actor</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  
					session_start();
					 if (!$_SESSION['id'] == 1){
					 header("Location: ./login.php"); 
					 }
					
                       include 'database.php';   
                       $pdo = Database::connect();
                       $sql = "SELECT movies.`id`,`year`,`genre`,`name`,actors.actor, directors.director FROM movies LEFT JOIN directors ON movies.director_id=directors.id LEFT JOIN actors ON movies.actor_id=actors.id;";
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['year'] . '</td>';
                                echo '<td>'. $row['genre'] . '</td>';
                                echo '<td>'. $row['name'] . '</td>';
								echo '<td>'. $row['director'] . '</td>';
								echo '<td>'. $row['actor'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
		 <div class="row">
                <p>
                    <a href="logout.php" class="btn btn-danger">Log Out</a>
                </p>
				</div>
    </div> <!-- /container -->
  </body>
</html>
