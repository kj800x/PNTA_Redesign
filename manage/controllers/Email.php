<?php
$to = stripslashes($_POST["TO"]);

// subject
$subject = $_POST["SUBJECT"];

// message
$message = $_POST["CONTENT"];

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'Reply-To: '. $_POST["REPLYTO"] . "\r\n";
$headers .= 'From: PNTA <pnta@pnta.org>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
<html>
  <head>
    <title> Attempted To Send An Email </title>
    <style> div {margin:10px;padding:5px;}</style>
  </head>
  <body style="background:blue">
    <div style="background:lightblue">
    
      <h1> Sent An Email! </h1>
      
      <h2> FROM: pnta@pnta.org </h2>
      
      <h2> TO: <?=stripslashes($_POST["TO"])?> </h2>
      
      <h2> REPLYTO: <?=$_POST["REPLYTO"]?> </h2>
      
      <h2> SUBJECT: <?=$_POST["SUBJECT"]?> </h2>
      
      <h2> CONTENT </h2>
      
      <div style="border:2px solid black; background:white;">
        <?=$_POST["CONTENT"]?>
      </div>
      
      <h1><a href="/manage/">Return to /manage/</a></h1>
      
    </div>
    <!--<div style="background:lightblue">
    
      <h1> SEND A TEST EMAIL TO THIS PAGE </h1>
      
      <form action="" method="POST">
        Reply To: (REPLYTO)<br /> 
        <input type="text" name="REPLYTO" /><br /><br />
        To: (TO)<br /> 
        <input type="text" name="TO" /><br /><br />
        Subject: (SUBJECT)<br />
        <input type="text" name="SUBJECT" /><br /><br />
        Content: (CONTENT)<br />
        <textarea name="CONTENT"></textarea><br /><br />
        <input type="submit">
      </form>
    </div>-->
  </body>
</html>