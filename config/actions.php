<?php 
session_start();
 include('db.php'); 

if (isset($_POST["add-mockup"]))
{
    
   
    $mockupName = $_POST['mockup_name'];
    $mockupType = $_POST['mockup_type'];
    $mockupPrice = $_POST['mockup_price'];
     
        
        $sql = $conn->prepare("INSERT INTO quizname (
                                                                    name,
                                                                    paymentRequired,
                                                                    cost,
                                                                    createdAt,
                                                                    updatedAt
                                                                )
                                                                VALUES (? , ? , ? , now() , now() )");
        $sql->bind_param("sii",$mockupName,$mockupType,$mockupPrice);
        $sql->execute();
        
        
        
      
       if ($sql->affected_rows > 0)
        {
           header("Location: ../index.php");
                 
        }
        else if($sql->affected_rows < 0)
        {
           echo "something goes wrong";
            
        }
 }



if (isset($_POST["answer-question"]))
{
    
   
    $answer = $_POST['answer'];
    $mockupId = $_POST['mId'];
    $questionId = $_POST['questionId'];
    $questionNumber = $_POST['questionNumber'];
    $nextQuestionNumber = $questionNumber + 1;
    $mark = $_POST['mark'];
    $userId = $_SESSION["id"];
    $goToResultPage = false;

    // Count number of questions
    $sql = $conn->prepare("SELECT COUNT(*) as totalQueestion FROM questions WHERE quizId = ? ");
     $sql->bind_param("i",$mockupId);
     $sql->execute();
     $result = $sql->get_result();



    if ($sql->affected_rows > 0)
     {
       $row = $result->fetch_assoc();
      if ($questionNumber == $row['totalQueestion']) {
          $goToResultPage = true;
      }
     }
     else if($sql->affected_rows < 0)
     {
         echo "something goes wrong on finding the question number";

     }
     
        // Check weather the answer is right or wrong
        $sql = $conn->prepare("SELECT correctAnswer FROM answers WHERE id = ? AND questionId = ?");
        $sql->bind_param("ii",$answer,$questionId);
        $sql->execute();
        $result = $sql->get_result();
        
        
      
       if ($sql->affected_rows > 0)
        {
          $row = $result->fetch_assoc();
          if ($row['correctAnswer']) {
              $totalscore = $mark;
          } else {
              $totalscore = 0;
          }

          // check weather already answerd or not
           $sql = $conn->prepare("SELECT id FROM useranswer WHERE userId = ? AND quizId = ? AND questionId = ?");
           $sql->bind_param("iii",$userId,$mockupId,$questionId);
           $sql->execute();
           $result = $sql->get_result();

          // If present then update
            if ($sql->affected_rows > 0)
            {
                    $sql = $conn->prepare("UPDATE useranswer SET answerId = ? , score = ? WHERE userId = ? AND quizId = ? AND questionID = ?");
                    $sql->bind_param("iiiii",$answer,$totalscore,$userId,$mockupId,$questionId);
                    $sql->execute();




                    if ($sql->affected_rows > 0)
                    {
                        echo "successfully updated";
                        if ($goToResultPage) {
                          header("Location: ../result.php");
                        } else {
                            # code...
                            header("Location: ../user.php?mId=$mockupId&num=$nextQuestionNumber");
                        }
                        

                    }
                    else if($sql->affected_rows < 0)
                    {
                        echo "something goes wrong on update";

                    }
            } 
            else if($sql->affected_rows < 0)
            {
                echo "something goes wrong on find";

            }
            else
            {
                // If not then add
                      $sql = $conn->prepare("INSERT INTO useranswer (
                                                                                 userId,
                                                                                 quizId,
                                                                                 questionId,
                                                                                 answerId,
                                                                                 score
                                                                             )
                                                                             VALUES (? , ? , ? , ? , ? )");
                     $sql->bind_param("iiiii",$userId,$mockupId,$questionId,$answer,$totalscore);
                     $sql->execute();




                    if ($sql->affected_rows > 0)
                     {
                         echo "successfully added";
                       if ($goToResultPage) {
                         header("Location: ../result.php");
                       } else {
                           # code...
                           header("Location: ../user.php?mId=$mockupId&num=$nextQuestionNumber");
                       }

                     }
                     else if($sql->affected_rows < 0)
                     {
                        echo "something goes wrong on add";

                     }

                  }
          }



 }


// Add question
 if (isset($_POST["add-question"]))
 {

     
     $mockup = $_POST['mockup'];
     $name = $_POST['name'];
     $choice1 = $_POST['choice_1'];
     $choice2 = $_POST['choice_2'];
     $choice3 = $_POST['choice_3'];
     $choice4 = $_POST['choice_4'];
     $answers = array($choice1,$choice2,$choice3,$choice4);
     $mark = $_POST['mark'];

     if(!empty($_POST['correct_choice'])) {

     $correctChoice = $_POST['correct_choice'];

     }
     


      $sql = $conn->prepare("INSERT INTO questions (
                                                                     quizId,
                                                                     questionText,
                                                                     mark,
                                                                     createdAt,
                                                                     updatedAt
                                                                 )
                                                                 VALUES (? , ? , ? , now() , now() )");
         $sql->bind_param("isi",$mockup,$name,$mark);
         $sql->execute();




        if ($sql->affected_rows > 0)
         {

            $questionId =  $conn->insert_id;
            $sql = $conn->prepare("UPDATE questions
                                JOIN (SELECT @rank := 0) r
                                SET number=@rank:=@rank+1;");
             //$sql->bind_param("ii",$questionId,$mockup);
             $sql->execute();




            if ($sql->affected_rows > 0)
             {
                $status = true;
                for ($i=1; $i < 5; $i++) { 
                    $correctAnswer = 0;
                    if ($i == $correctChoice) {
                       $correctAnswer = 1;
                    }
                    $sql = $conn->prepare("INSERT INTO answers (
                                                                                questionId,
                                                                                correctAnswer,
                                                                                answerText
                                                                            )
                                                                            VALUES (? , ? , ? )");
                    $sql->bind_param("iis",$questionId,$correctAnswer,$answers[$i - 1]);
                    $sql->execute();

                    if ($sql->affected_rows < 0)
                    {
                        $status = false;
                    }

                }

                if ($status) {
                    header("Location: ../index.php");
                } 
             }


            //header("Location: ../index.php");
            
            

         }
         else if($sql->affected_rows < 0)
         {
            echo "something goes wrong";

         }
  }




?>