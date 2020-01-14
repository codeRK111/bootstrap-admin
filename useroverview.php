
<?php include('config/db.php'); ?>


<?php

$freeMockups = array();
$paidMockups = array();

$sql = $conn->prepare("SELECT id ,
                              name ,
                              paymentRequired
                              from quizname
                              ");
//$sql->bind_param();
$sql->execute();
$result = $sql->get_result();


if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()) 
    {
         if ($row['paymentRequired'] == 0) {
               array_push($freeMockups, $row);
         } else {
               array_push($paidMockups, $row);
         }
         
       
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>SB Admin 2 - Dashboard</title>

        <!-- Custom fonts for this template-->
        <link
            href="vendor/fontawesome-free/css/all.min.css"
            rel="stylesheet"
            type="text/css"
        />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet"
        />

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet" />
        <link href="css/user.css" rel="stylesheet">
        <link href="css/quiz.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet" />

    </head>
<body class="user-body">



<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
  <a class="navbar-brand js-scroll-trigger" href="#page-top">
    <span class="d-block d-lg-none">Clarence Taylor</span>
    <span class="d-none d-lg-block">
      <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/profile.jpg" alt="">
    </span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="#about">Home</a>
      </li>
       <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="logout.php">logout</a>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="#education">Education</a>
      </li>
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="#skills">Skills</a>
      </li>
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="#interests">Interests</a>
      </li>
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="#awards">Awards</a>
      </li> -->
    </ul>
  </div>
</nav>

<div class="container-fluid p-0">

  <section class="free-courses  p-5">
    <h5>Free quizes</h5>
     <div class="mt-3">
          <div class="row">
            <?php

            if (count($freeMockups) == 0) {
                echo "<h5 class='text-center w-100'>No quiz found</h5>";
            }
            else
            {
                 foreach ($freeMockups as $key ) {
                      echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mt-3">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">'.$key["name"].'</h5>
                            <a href="user.php?mId='.$key["id"].'&num=1" class="btn btn-primary">Go somewhere</a>
                          </div>
                        </div>
                      </div>';
                 }
            }

            ?>
          </div>
     </div>
  </section>

  <section class="paid-courses  p-5 mt-5">
    
     <h5>Paid quizes</h5>
     <div class="mt-3">
          <div class="row">
               <?php
               if (count($paidMockups) == 0) {
                   echo "<h5 class='text-center w-100'>No quiz found</h5>";
               }
               else
               {
                    foreach ($paidMockups as $key ) {
                         echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mt-3">
                           <div class="card">
                             <div class="card-body">
                               <h5 class="card-title">'.$key["name"].'</h5>
                               <a href="user.php?mId='.$key["id"].'" class="btn btn-primary">Go somewhere</a>
                             </div>
                           </div>
                         </div>';
                    }
               }
               
               
               ?>
           
          </div>
     </div>
  </section>

  



</div>

<?php include('includes/footer.php'); ?>