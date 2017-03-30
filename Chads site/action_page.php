<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
//Variables
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['comment'];
//Validate first
if(empty($name)||empty($visitor_email))
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

//Composer of Email
$email_from = 'greatmadisonavenue@gmail.com';
$email_subject = "A New Message From Your Website";
$email_body = "VISITOR NAME: $name \n".
"VISITOR EMAIL: $visitor_email \n".
				"_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _\n".
				" \n".
				"SUBJECT: $subject \n".
				"MESSAGE BODY: $message \n".
				" \n".
//server function code
$to = "greatmadisonavenue@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
mail($to,$email_subject,$email_body,$headers);

//done. redirect to thank-you page.
header('Location: thank-you.html');



// Function to validate against any email injection attempts (SECURITY) DO NOT DELETE
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
