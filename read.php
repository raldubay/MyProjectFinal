<?php
# ------------------------------------------------------------------------------------------------ #
# program: read.php
# author:  Rashed Aldubayyan
# course:  cis355 Winter 2015
# purpose: 
# ------------------------------------------------------------------------------------------------ #
# input:   $_POST, or nothing
#
#				  displayHTMLHead
#               
#
# output:  HTML, CSS, JavaScript code 
# --------------------------------------------------------------------------- #
session_start();

	 if (!$_SESSION['id'] == 1){
	 header("Location: ./login.php"); 
	 }
	
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: login.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT movies.`id`,`year`,`genre`,`name`,actors.actor, directors.director FROM movies LEFT JOIN directors ON movies.director_id=directors.id LEFT JOIN actors ON movies.actor_id=actors.id WHERE movies.`id`= " . $id;
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
	
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read Movie Information</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Year</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['year'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Genre</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['genre'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['name'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">director</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['director'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Actor</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['actor'];?>
                            </label>
                        </div>
                      </div>
					 
                        <div class="form-actions">
                          <a class="btn" href="outdex.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>