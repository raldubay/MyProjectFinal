<?php
# ------------------------------------------------------------------------------------------------ #
# program: logout.php
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


if ( !empty($_POST)) {
if(session_destroy())
{
header("Location: outdex.php");
}
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
                        <h3>Logout</h3>
                    </div>
                     
                    <form class="form-horizontal" action="logout.php?logout=true" method="post">
                      <input type="hidden" name="logout" value="<?php echo $emp_id;?>"/>
                      <p class="alert alert-error">Are you sure you would like to logout?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="outdex.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>