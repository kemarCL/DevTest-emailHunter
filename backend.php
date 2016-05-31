<?php
/*
   Backend recieves an email then verifies it with emailhunter
   Response is then stored in a file and appropriate response sent back to the frontend
   Kemar Clarke

*/

//Code below checks if an email was posted 
if (isset($_POST["email"])) 
{

    //setting up cUrl request to be sent to the emailhunter API
    $handle =curl_init();
    curl_setopt($handle,CURLOPT_URL ,'https://api.emailhunter.co/v1/verify?email='.$_POST["email"].'&api_key=2882d3c37060ca2364247dbb15e51cd002dc408a');
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

    //execute the cUrl request and store the result
    $response = curl_exec($handle);
    curl_close($handle);


     //code below prepares or create the file to write the API response to

    $ini= fopen('results.txt', 'a');

    fwrite($ini, $response);

    fclose($ini);


     //decoding the JSON response to send back to the frontend
    $final = json_decode($response,true);
    $fr=$final['result'];

    //retuning a suitable response to the front end
    echo $fr;

}


?>

                  
