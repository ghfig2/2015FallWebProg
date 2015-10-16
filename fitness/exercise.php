<?php

session_start();
$exercises = $_SESSION['fitrak'];

if ($_POST) {
    if (isset($_GET['id'])) {
        $exercises[$_GET['id']] = $_POST;
    } else {
        $exercises[] = $_POST;
    }
    $_SESSION['fitrak'] = $exercises;
}

if (isset($_GET['edit'])) {
    $exercise = $exercises[$_GET['edit']];
} else if (isset($_GET['delete'])) {
    unset($exercises[$_GET['delete']]);
    $_SESSION['fitrak'] = $exercises;
} else {
    $exercise = array();
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Bootstrap // Guilherme</title>
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
                  <li class="active"><a href="exercise.php">My Exercises</a></li>
                  <li><a href="food.php">My Food</a></li>
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
            <div class="col-md-5">
               <h3>What have you done?</h3>
               <h5>Add more activities in your log</h5>
               <p>
                  <button type="button" class="btn btn-primary btn-lg" id="aerobic">Aerobic</button> or 
                  <button type="button" class="btn btn-primary btn-lg" id="workout">Work Out</button>
               </p>
               <form role="form" action="" method="POST" id="aerobic-form" style="display: none">
                  <input type="hidden" name="type" value="Aerobic">
                  <div class="form-group" id="aerobic-exercises">
                     <label for="exercise">Select the exercise you did:</label>
                     <select class="form-control" name="exercise" id="exercise" required>
                        <option disabled selected value=''>-- Select --</option>
                        <option>Running</option>
                        <option>Bicycling</option>
                        <option>Swimming</option>
                     </select>
                  </div>
                  <div class="form-group" id="duration-form">
                     <label for="duration">How long time?</label>
                     <input type="duration" class="form-control" name="duration" id="duration" value="<?=$exercise['duration'];?>">
                  </div>
                  <div class="form-group" id="distance-form">
                     <label for="distance">How long distance?</label>
                     <input type="text" class="form-control" name="distance" id="distance" value="<?=$exercise['distance'];?>">
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-success" id="submit">Save</button>
                  </div>
               </form>
               <form role="form" action="" method="POST" id="workout-form" style="display: none">
                  <input type="hidden" name="type" value="Work Out">
                  <div class="form-group" id="workout-exercises">
                     <label for="exercise">Select the exercise you did:</label>
                     <select class="form-control" name="exercise" id="exercise" required>
                        <option disabled selected value=''>-- Select --</option>
                        <option>Abdominal</option>
                        <option>Back</option>
                        <option>Push Ups</option>
                        <option>Biceps</option>
                        <option>Triceps</option>
                        <option>Legs</option>
                     </select>
                  </div>
                  <div class="form-group" id="series-form">
                     <label for="series">How many times?</label>
                     <input type="number" class="form-control" name="series" id="series" value="<?=$exercise['series'];?>">
                  </div>
                  <div class="form-group" id="weight-form">
                     <label for="weight">Weight?</label>
                     <input type="number" class="form-control" name="weight" id="weight" value="<?=$exercise['weight'];?>">
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-success" id="submit">Save</button>
                  </div>
               </form>
            </div>
            <div class="col-md-6">
               <h2>Your exercises:</h2>
               <p>List of exercises you have done yet</p>
               <h4>Aerobic</h4>
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Exercise</th>
                        <th>Duration</th>
                        <th>Distance</th>
                        <th>Calories burned</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        foreach($exercises as $id => $ex): 
                        if ($ex['type'] == "Aerobic") { ?>
                     <tr>
                        <td><?=$ex['exercise'];?></td>
                        <td><?=$ex['duration'];?></td>
                        <td><?=$ex['distance'];?></td>
                        <td>563</td>
                        <td>
                           <a href="?edit=<?=$id;?>"><span class="glyphicon glyphicon-edit text-warning"></span></a>
                           <a href="?delete=<?=$id;?>"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                        </td>
                     </tr>
                     <?php }
                        endforeach; ?>
                  </tbody>
               </table>
               <h4>Work Out</h4>
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Exercise</th>
                        <th>Series</th>
                        <th>Weight</th>
                        <th>Calories burned</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        foreach($exercises as $id => $ex): 
                        if ($ex['type'] == "Work Out") { ?>
                     <tr>
                        <td><?=$ex['exercise'];?></td>
                        <td><?=$ex['series'];?></td>
                        <td><?=$ex['weight'];?></td>
                        <td>563</td>
                        <td>
                           <a href="?edit=<?=$id;?>"><span class="glyphicon glyphicon-edit text-warning"></span></a>
                           <a href="?delete=<?=$id;?>"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                        </td>
                     </tr>
                     <?php }
                        endforeach; ?>
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
             var edtion = '<?php echo $_GET["edit"]; ?>';
             if(edtion) {
                 var type = '<?php echo $exercise["type"]; ?>';
                 if (type == "Aerobic") {
                $("#aerobic").prop("class","btn btn-primary btn-lg");
                $("#workout").prop("class","btn btn-default btn-lg");
                $("#workout").prop("disabled","disabled");
                $("#aerobic-form").show();
                     
               } else if (type == "Work Out"){
                $("#workout").prop("class","btn btn-primary btn-lg");
                $("#aerobic").prop("class","btn btn-default btn-lg");
                $("#aerobic").prop("disabled","disabled");
                $("#workout-form").show();
                   
               }
             }
         });
         
            $("#aerobic").click(function(){
                $("#aerobic").prop("class","btn btn-primary btn-lg");
                $("#workout").prop("class","btn btn-default btn-lg disabled");
                $("#workout-form").hide();
                $("#aerobic-form").show();
            });
            
            $("#workout").click(function(){
                $("#workout").prop("class","btn btn-primary btn-lg");
                $("#aerobic").prop("class","btn btn-default btn-lg disabled");
                $("#aerobic-form").hide();
                $("#workout-form").show();
            });
      </script>
   </body>
</html>