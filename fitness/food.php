<?php

function sortDate($a, $b)
{
    return strtotime($a[1]) - strtotime($b[1]);
}

session_start();
$foods = $_SESSION['foodtrack'];
$limit = $_SESSION['limit'];

if ($_POST) {
    if (isset($_POST['limit'])) {
        $limit = $_POST['limit'];
    } else if (isset($_GET['edit'])) {
        $foods[$_GET['edit']] = $_POST;
    } else {
        $foods[] = $_POST;
    }
    
    $_SESSION['foodtrack'] = $foods;
    $_SESSION['limit']     = $limit;
    header('Location: food.php');
}

if (isset($_GET['edit'])) {
    $food = $foods[$_GET['edit']];
} else if (isset($_GET['delete'])) {
    unset($foods[$_GET['delete']]);
    $_SESSION['foodtrack'] = $foods;
} else {
    $food = array();
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Fitrack // Get fit!</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="index.php">FITrack</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
               <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="exercise.php">My Exercises</a></li>
                  <li class="active"><a href="food.php">My Food</a></li>
                  <li><a href="#">Report</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-plus"></span> Sign Up</a></li>
                  <li class="active"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login <span class="sr-only">(current)</span></a></li>
               </ul>
            </div>
            <!--/.nav-collapse -->
         </div>
      </nav>
      <div class="container">
         <br>
         <br>
         <br>
         <div class="row">
            <div class="col-md-6">
               <form class="form-inline" role="form" action="" method="POST">
                  <div class="form-group">
                     <h3>I can eat
                        <input type="number" class="form-control input-lg" name="limit" id="limit" value="<?=$limit;?>" required>
                        calories per day &nbsp;
                     </h3>
                  </div>
                  <button type="submit" class="btn btn-success btn-lg">I'm Ready!</button>
               </form>
               <hr>
               <h3>Food Diary</h3>
               <h5>Track what you eat</h5>
               <form role="form" action="" method="POST" id="food-form" name="food-form">
                  <div class="form-group" id="date-form">
                     <label for="date">Date:</label>
                     <input type="date" class="form-control" name="date" id="date" value="<?=$food['date'];?>">
                  </div>
                  <div class="form-group" id="meal-form">
                     <label for="meal">Meal:</label>
                     <select class="form-control" name="meal" id="meal" required>
                        <option disabled selected value=''>-- Select --</option>
                        <option>Breakfast</option>
                        <option>Brunch</option>
                        <option>Lunch</option>
                        <option>Dinner</option>
                        <option>Snacks</option>
                     </select>
                  </div>
                  <div class="form-group" id="food2-form">
                     <label for="food">What did you eat or drink?</label>
                     <input type="text" class="form-control" name="food" id="food" value="<?=$food['food'];?>" required>
                  </div>
                  <div class="form-group" id="calories-form">
                     <label for="calories">Calories</label>
                     <input type="number" class="form-control" name="calories" id="calories" value="<?=$food['calories'];?>" required>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-success" id="submit">Save</button>
                  </div>
               </form>
            </div>
            <div class="col-md-6">
               <h2>Your Log:</h2>
               <p>List of what you have eatten</p>
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Date</th>
                        <th>Meal</th>
                        <th>Food</th>
                        <th>Calories</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     if(isset($foods)) {
                        usort($foods, "sortDate");
                        foreach($foods as $id => $f): 
                           $totalCalories += $calories; ?>
                     <tr>
                        <td><?=$f['date'];?></td>
                        <td><?=$f['meal'];?></td>
                        <td><?=$f['food'];?></td>
                        <td><?=$f['calories'];?></td>
                        <td>
                           <a href="?edit=<?=$id;?>"><span class="glyphicon glyphicon-edit text-warning"></span></a>
                           <a href="?delete=<?=$id;?>"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                        </td>
                     </tr>
                     <?php
                        endforeach;
                     } else {
                        echo"<tr><td>No records found</td></tr>";
                     }
                     ?>
                  </tbody>
               </table>
               <hr>
            </div>
         </div>
         <!-- Site footer -->
         <footer class="footer text-center">
            <p>&copy; FITrack 2015</p>
         </footer>
      </div>
      <!-- /container -->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script>
         $(document).ready(function(){
             $('#limit').css('width', '100px')
             var edtion = '<?php echo $_GET["edit"]; ?>';
             if(edtion) {
                 var meal = '<?php echo $food["meal"]; ?>';
                 $("#meal").val("<?php echo $food['meal']; ?>");
             }
         });
      </script>
   </body>
</html>