
<?php
# ------------------------------------------------------------------------------------------------ #
# program: update.php
# author:  Rashed Aldubayyan
# course:  cis355 Winter 2015
# purpose: Update.php - this file updates the tables  from the user 
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
    }
     
    if ( !empty($_POST)) {

        // keep track validation errors
        $yearError = null;
        $genreError = null;
        $nameError = null;
		$actorError = null;
		$directorError = null;
         
        // keep track post values
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $name = $_POST['name'];
		$actor = $_POST['actor'];
		$director = $_POST['director'];
         
        // validate input
        $valid = true;
        if (empty($year)) {
            $yearError = 'Please enter a Year';
            $valid = false;
        }
         
        if (empty($genre)) {
            $genreError = 'Please enter Genre';
            $valid = false;
  
        }
         
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
		
			if (empty($actor)) {
            $actorError = 'Please enter an actor';
            $valid = false;
        }
		
		if (empty($director)) {
            $directorError = 'Please enter a director';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE movies set year = ?, genre = ?, name =?, director_id = ?, actor_id = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($year,$genre,$name,$director, $actor, $id));
            Database::disconnect();
            header("Location: outdex.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM movies where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $year = $data['year'];
        $genre = $data['genre'];
        $name = $data['name'];
		$actor = $data['actor_id'];
		$director = $data['director_id'];
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
                        <h3>Update Movie Information</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($yearError)?'error':'';?>">
                        <label class="control-label">Year</label>
                        <div class="controls">
                            <input name="year" type="text"  placeholder="Year" value="<?php echo !empty($year)?$year:'';?>">
                            <?php if (!empty($yearError)): ?>
                                <span class="help-inline"><?php echo $yearError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($genreError)?'error':'';?>">
                        <label class="control-label">Genre</label>
                        <div class="controls">
                            <input name="genre" type="text" placeholder="Genre" value="<?php echo !empty($genre)?$genre:'';?>">
                            <?php if (!empty($genreError)): ?>
                                <span class="help-inline"><?php echo $genreError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					   <div class="control-group <?php echo !empty($directorError)?'error':'';?>">
                        <label class="control-label">Director</label>
                        <div class="controls">
						<select name=director>
						
						<?php
						$pdo = Database::connect ();
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT * FROM directors";
						foreach($pdo->query($sql) as $row)
						{
							if ($row[0] == $director)
								echo "<option selected value='$row[0]'>$row[1]</option>";
							echo "<option value='$row[0]'>$row[1]</option>";
						}
						?>
						</select>

                            <?php if (!empty($directorError)): ?>
                                <span class="help-inline"><?php echo $directorError;?></span>
                            <?php endif;?>
		
					     </div>	
                      </div>
					  
					  
					  
					  
					  
					  
					   <div class="control-group <?php echo !empty($actorError)?'error':'';?>">
                        <label class="control-label">Actor</label>
                        <div class="controls">
						
						<select name=actor>
						
						<?php
						$pdo = Database::connect ();
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT * FROM actors";
						foreach($pdo->query($sql) as $row)
						{
							if ($row[0] == $actor)
								echo "<option selected value='$row[0]'>$row[1]</option>";
							echo "<option value='$row[0]'>$row[1]</option>";
						}
						?>
						</select>
						
						
						 
                            <?php if (!empty($actorError)): ?>
                                <span class="help-inline"><?php echo $actorError;?></span>
                            <?php endif;?>
		
					     </div>	
                      </div>
					  
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="outdex.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
