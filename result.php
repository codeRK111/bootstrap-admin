<?php include('config/db.php'); ?>
<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit; 
}

if (isset($_GET['mId']) && isset($_GET['userId']) && isset($_GET['questionId']) ){
     # code...
     $mId = $_GET['mId'];
     $userId = $_GET['userId'];
     $questionId = $_GET['questionId'];
     $totalscore;
     $userscore;
     $rightanswer;
     $wronganswer;
     $totalquestions;


      $sql = $conn->prepare("SELECT SUM(u.score) as userscore,SUM(u.realscore) as totalscore,(SELECT COUNT(*) from useranswer WHERE userId = u.userId AND quizId = u.quizId AND score = 0) as wronganswer,(SELECT COUNT(*) from useranswer WHERE userId = u.userId AND quizId = u.quizId AND score != 0) as rightanswer,(SELECT COUNT(*) FROM questions WHERE quizId = u.quizId) as totalquestions FROM useranswer u WHERE quizId = ?  AND userId = ?");
      $sql->bind_param("ii",$mId,$userId);
      $sql->execute();
      $result = $sql->get_result();



     if ($sql->affected_rows > 0)
      {
        $row = $result->fetch_assoc();
       // print_r($row);
        $totalscore = $row['totalscore'];
        $userscore =  $row['userscore'];
        $wronganswer =  $row['wronganswer'];
        $rightanswer =  $row['rightanswer'];
        $totalquestions =  $row['totalquestions'];
      }
      else if($sql->affected_rows < 0)
      {
          echo "something goes wrong on finding the question number";

      }


}






?>
<?php include('config/db.php'); ?>

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
         <h5 class="text-light border-bottom border-light w-100 p-3"><?php echo $_SESSION['name']; ?></h5>
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="useroverview.php">Home</a>
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

  <section class="free-courses d-flex w-100 justify-content-center  p-5">
     <div class="p-3   w-75">
          <h5 class="mb-3  pb-3">Result</h5>
         <table class="table table-bordered w-100">
               <tr>
                 <td scope="row">Total Score</td>
                 <td class="text-info"><?php echo $totalscore; ?></td>
               </tr>
               <tr>
                 <td scope="row">Your Score</td>
                 <td class="text-info"><?php echo $userscore; ?></td>
               </tr>
               <tr>
                 <td scope="row">Total questions</td>
                 <td class="text-info"><?php echo $totalquestions; ?></td>
               </tr>
               <tr>
                 <td scope="row">Right Answer</td>
                 <td class="text-info"><?php echo $rightanswer; ?></td>
               </tr>
               <tr>
                 <td scope="row">Wrong Answer</td>
                 <td class="text-info"><?php echo $wronganswer; ?></td>
               </tr>
         </table>
     </div>
  </section>

  <section class="free-courses p-5 d-flex w-100 justify-content-center">
       <div class="p-3   w-75">
          <h5 class="mb-3 pb-3">Review</h5>

     <?php
     
     $sql = $conn->prepare("SELECT  (SELECT questionText from questions WHERE id = u.questionId ) as question, (SELECT answerText from answers WHERE id = u.answerId ) as useranswer,u.score, (SELECT answerText from answers WHERE questionId = u.questionId AND correctAnswer = 1) as rightanswer FROM useranswer u WHERE quizId = ?  AND userId = ?");
      $sql->bind_param("ii",$mId,$userId);
      $sql->execute();
      $result = $sql->get_result();



     if ($sql->affected_rows > 0)
      {
        $index = 1;
        while ($row = $result->fetch_assoc()) {
            if ($row["score"]) {
                 $class = "right-answer";
            }else {
                  $class = "wrong-answer";
            }
          echo '<div class="mb-5 border p-3">';
          echo '<p>('.$index.') '.$row["question"].'</p>';
          echo '<b>Your Answer</b><br>';
          echo '<p class="'.$class.'">'.$row["useranswer"].'</p>';
          echo '<b>Right Answer</b><br>';
          echo '<p class="right-answer">'.$row["rightanswer"].'</p>';
          echo '</div>';
            $index++;
        }
       
      }
      else if($sql->affected_rows < 0)
      {
          echo "something goes wrong on finding the question number";

      }
     
     ?>
       </div>
  </section>

</div>

<?php include('includes/footer.php'); ?>