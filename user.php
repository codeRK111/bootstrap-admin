<?php include('config/db.php'); ?>
<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit; 
}

?>
<?php
if (isset($_GET['num']) && isset($_GET['mId'])) {
    $num = $_GET['num'];
    $mId = $_GET['mId'];
     $question;
     $mark;
     $quizname;
     $questionId;
     $answers = array();
     $backlink = 'mId='. (string)$mId . '&num='. (string)($num - 1);
    // echo $backlink;



    $sql = $conn->prepare("SELECT q.questionText,
                                   q.id,
                                   q.mark,
                                   m.name
                              from questions q JOIN quizname m ON q.quizId = m.id WHERE q.number = ? AND q.quizId = ?
                              ");
     $sql->bind_param("ii",$num,$mId);
     $sql->execute();
     $result = $sql->get_result();



    if ($sql->affected_rows > 0)
     {
        $row = $result->fetch_assoc();
        $question = $row["questionText"];
        $mark = $row["mark"];
        $quizname = $row["name"];
        $questionId = $row["id"];

        $sql = $conn->prepare("SELECT id,answerText
                                 from answers  WHERE questionId = ? 
                                 ");
        $sql->bind_param("i",$questionId);
        $sql->execute();
        $result = $sql->get_result();

        if ($sql->affected_rows > 0)
        {

             while($row = $result->fetch_assoc()) 
             {
                  array_push($answers, $row);


             }

            
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
    <h5 class="text-light border-bottom border-light w-100 p-3"><?php echo $_SESSION['name']; ?></h5>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="useroverview.php">Home</a>
        </li>
         <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="logout.php">logout</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#experience">Experience</a>
        </li>
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

  <div class="">

    <section class="fullHeightvh  p-5">
      <div class="w-100">
           <div class="p-5">
                <h4 class="text-center"><?php echo $quizname; ?></h4>
                <h4 class="text-center mt-3">Fullmark: <?php echo $mark; ?></h4>
           </div>
           <hr>
        <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 mt-5">
         <div class="shadow p-5  bg-white rounded h-100">
              <form action="config/actions.php" method="post" id="question-form">
              <ul class="quiz">
                   <li>
                        <h5><?php echo $question; ?></h5>
                        <ul class="choices  mt-3">
                             <?php
                             
                             foreach ($answers as $key) {
                                  # code...
                                  echo '<li class="p-3 mb-3  border rounded"><label><input type="radio" required name="answer" value="'.$key["id"].'"><span>'.$key["answerText"].'</span></label></li>';
                             }
                             ?>
                            
                        </ul>
                   </li>
                   <li class="mt-3 d-flex justify-content-between w-100">
                   <?php
                   if ($num != 1) {
                       echo '<a href="user.php?'.$backlink.'" class="btn btn-primary btn-lg">Back</a>';
                   } else {
                        echo '<p></p>';
                   }
                   
                   ?>
                    <button class="btn btn-primary btn-lg" name="answer-question" type="submit">Submit</button>
                   </li>
              </ul>

              <input type="hidden" name="questionNumber" value="<?php echo $num; ?>" id="question-number">
              <input type="hidden" name="mId" value="<?php echo $mId; ?>"">
              <input type="hidden" name="questionId" value="<?php echo $questionId; ?>"">
              <input type="hidden" name="mark" value="<?php echo $mark; ?>"">
              </form>
         </div>

        </div>
       <?php include('includes/questionNumber.php') ?>
        </div>
      </div>
    </section>

    <hr class="m-0">



  </div>

  <?php include('includes/footer.php'); ?>