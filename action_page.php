<?php
if(isset($_POST['email'])) {
     
	 
    // CHANGE THE TWO LINES BELOW
    $email_to = "steven.purn@gmail.com";
     
    function died() {
		echo '<script language="javascript">';
		echo 'alert("Sorry, something went wrong.")';
		echo '</script>';
		echo "<meta http-equiv='refresh' content='0;url=http://stevenpurn.com/about.html'>";
		die();
    }
     
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['body']) ||
        !isset($_POST['email'])){
        died();       
    }
     
    $name = $_POST['name'];
    $email_subject = $_POST['subject'];
    $email_from = $_POST['email'];
    $body = $_POST['body'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The name you entered does not appear to be valid.<br />';
  }
  if(strlen(body) < 2) {
    $error_message .= 'The body you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Body: ".clean_string($body)."\n";
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- place your own success html below -->
echo '<script language="javascript">alert("Thanks! I'll get back to you soon.");</script>';
echo '<META HTTP-EQUIV=REFRESH CONTENT="0; 'about.html'">';

<?php
}
die();
?>