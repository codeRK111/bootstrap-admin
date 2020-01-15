<!-- <?php include('config/db.php'); ?> -->
<?php
if (isset($_GET['num']) && isset($_GET['mId'])) {
    $num = $_GET['num'];
    $mId = $_GET['mId'];
$answerNumbers = array();



    $sql = $conn->prepare("SELECT q.number
                              from questions q JOIN quizname m ON q.quizId = m.id WHERE  q.quizId = ?
                              ");
     $sql->bind_param("i",$mId);
     $sql->execute();
     $result = $sql->get_result();



    if ($sql->affected_rows > 0)
     {

          while($row = $result->fetch_assoc()) 
          {
               array_push($answerNumbers, $row['number']);


          }
        

     }
    // print_r($numbers);
}

?>



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 mt-5">
     <div class="p-lg-5 p-md-3 shadow   bg-white rounded h-100">
          <h5 class="mb-3 text-center">Question Number</h5>
     <div  class=" number-wrapper">
            
     <?php
     foreach ($answerNumbers as $value) {

          if ($num == $value) {
               $class = "current-question";
          } 
          else {
               $class = "";
          }
          

          echo '<a href="user.php?mId='.$mId.'&num='.$value.'" class="question-number '.$class.'" id="question-'.$value.'">'.$value.'</a>';
     }
     
     ?>
            

     </div>
     </div>
</div>