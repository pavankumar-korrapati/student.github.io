<?php
session_start();
include 'connect.php';
if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
   

    $email=mysqli_real_escape_string($con,$_REQUEST['email']);
    $password=mysqli_real_escape_string($con,$_REQUEST['password']);
    $qr=mysqli_query($con,"select * from users where email=' ".$email." ' and password=' ".md5($password)." ' ");
   if(mysqli_num_rows($qr)>0)  {
         $data=mysqli_fetch_assoc($qr);
         $_session['user_data']=$data;
         if($data['usertype']==1){
            header("location:teacher_home.php?");
         }
         else{
            header("location:student_home.php?");
         }
       }
    else{
        header("location:index.php?error=Invalid login Details");
    }

}
else{
    header("location:index.php?error=please Enter Email and password");
}