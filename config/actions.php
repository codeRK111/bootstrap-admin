<?php 
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




?>