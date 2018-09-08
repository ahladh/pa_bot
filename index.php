<?php 
  
$method = $_SERVER['REQUEST_METHOD'];
   
// Process only when method is POST
if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
    $type = $json->result->metadata->intentName;
    $text = $json->result->parameters->text;
    $date = $json->result->parameters->date;  
 
 
   $dbServerName = "52.14.75.147:3306";
   $dbUsername   = "ahladh";
   $dbPassword   = "Ahladh123%";
   $dbName       = "pa_bot";
     
 
    $conn = new mysqli($dbServerName,$dbUsername,$dbPassword,$dbName);
 
    if ($type == "Genral_date")
    {
  
       $result = mysqli_query($conn,"SELECT * FROM `bio-metric` WHERE `day` = '$date' AND `name` = '$text' AND `status` LIKE 'yes' ");
     
  
         if ($result->num_rows > 0) 
           {
    
               $speech = "Yes he/she is in college :Genral_date";
   
           }
         else
           {
              $speech = "Sorry, I think he/she has not come yet to college :Genral_date";
           }
 
 
    }
    else
    {
         
       $result = mysqli_query($conn,"SELECT * FROM `bio-metric` WHERE `name` = '$text'  AND `status` LIKE 'yes'");
     
            
         if ($result->num_rows > 0) 
           {
                
               $speech = "Yes he/she is in college : Genral";
   
           }
         else
           {
              $speech = "Sorry, I think he/she has not come yet to college :Genral";
           }
 
 
 
 
    }
    $response = new \stdClass();
    $response->speech = $speech;
    $response->displayText = $speech;
    $response->source = "webhook";
    echo json_encode($response);
}
else
{
    echo "Method not allowed";
}
   
?>
