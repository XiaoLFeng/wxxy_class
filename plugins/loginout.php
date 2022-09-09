<?PHP
setcookie( 'studentID' , '' , time()-1 , '/' , '');
header('location: /auth.php');