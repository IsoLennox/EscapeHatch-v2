<?php require_once("inc/session.php"); 
require_once("inc/functions.php"); 
require_once("inc/db_connection.php"); 
require_once("inc/validation_functions.php"); 
confirm_logged_in(); ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>EscapeHatch</title>
        <meta name="description" content="An interactive PDF library">
<!--        Main stylesheet-->
        <link rel="stylesheet" href="css/style.css">
<!--        link to font awesome-->
         <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--         GOOGLE FONTS-->
          <link href='http://fonts.googleapis.com/css?family=Merriweather:400,400italic,900italic,900' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
<!--   JS VERSIONS-->
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.js"></script>
   
    </head>
    
    
    
    
    
    
<body>
     
    <script>
        //FADE OUT MESSAGES
      setTimeout(function() {
          $(".message").fadeOut(800);
      }, 5000);
     </script>
    
    
    
<!--    FULL SITE  -->
    <header id="full">
        <span class="left min-five"><a href="index.php"><img id="logo" src="img/logo.png" alt="EscapeHatch"></a><a title="Your Profile" href="profile.php?user=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username']; ?></a></span>
        
        
<!--        USER ICONS -->
    <span class="right username"> 
     <a href="new_post.php"><i class="fa fa-pencil"></i> New Post</a>
       | <a href="index.php"><i class="fa fa-home" title="Home"></i></a> | <a href="index.php?browse"><i class="fa fa-globe" title="Explore"></i></a> | 
       <a title="Log Out" href="logout.php"><i class="fa fa-sign-out"></i></a> </span>
        
<!--   HEADER SEARCH BAR       -->
            
 <form class="center search" id="search_all" action="search.php?all" method="post">

    <input name="query" value="" placeholder="Search For Users and Tags" autocomplete="off" name="author" id="author" value="<?php echo $name; ?>" type="text" >
    <input type="submit" name="submit" value="&#xf002;" />
 
 </form> 
         
        
          </header>
          
          
          
          
<!--          MOBILE        -->
              <header id="mobile">
        <span class="left"><a href="index.php">EscapeHatch</a></span>
        <!--   HEADER SEARCH BAR       -->
            
 <form class="right search" id="search_all" action="search.php?all" method="post">
    <input name="query" value="" placeholder="Search For Users and Tags" autocomplete="off" name="author" id="author" value="<?php echo $name; ?>" type="text" >
    <input type="submit" name="submit" value="&#xf002;" />
 
 </form> 
        <a href="new_post.php"><i class="fa fa-pencil"></i> New Post</a>
<!--        USER ICONS -->
    <div class="center username"><a title="Your Profile" href="profile.php?user=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username']; ?></a>  | <a href="index.php"><i class="fa fa-home" title="Home"></i></a> | <a href="index.php?browse"><i class="fa fa-globe" title="Explore"></i></a> |
        <a title="Log Out" href="logout.php"><i class="fa fa-sign-out"></i></a> </div>
        

          </header>
        
        
        
        <div class="clearfix" id="page"> 
              <?php echo message(); ?>
              <?php echo form_errors($errors); ?>
         

