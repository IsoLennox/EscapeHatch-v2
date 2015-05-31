<?php include("inc/header.php"); 

//determine whose profile we are looking at 
if(isset($_GET['user'])){
    $user_id=$_GET['user'];
    
    //GET USERNAME
    $find_user = find_user_by_id($user_id);
    $username= $find_user['username'];
    
    
}elseif(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
    
    //GET USERNAME
    $find_user = find_user_by_id($user_id);
    $username= $find_user['username'];
    
    
}else{
    $user_id=$_SESSION['user_id'];
    $username = $_SESSION['username'];
   
}


if(isset($_GET['contact'])){
    $user_id=$_GET['with'];
    if($_GET['contact'] == 0 ){
        //remove contact
    $query  = "DELETE FROM contacts WHERE contact_id={$user_id} AND user_id={$_SESSION['user_id']} LIMIT 1";  
    $result = mysqli_query($connection, $query);
    $_SESSION['message']="Removed Contact!";
        redirect_to('profile.php?user='.$user_id);
        
    }else{
        //add contact
    $query  = "INSERT INTO contacts SET contact_id={$user_id}, user_id={$_SESSION['user_id']}";  
    $result = mysqli_query($connection, $query);
    $_SESSION['message']="Added Contact!";
        redirect_to('profile.php?user='.$user_id);
    
    }
}



//GET PROFILE IMAGE AND CONTENT
    $query  = "SELECT * FROM users WHERE id={$user_id} LIMIT 1";  
    $result = mysqli_query($connection, $query);
     $num_rows=mysqli_num_rows($result);
//    if($result){
    if($num_rows ==1){
        $profile_array=mysqli_fetch_assoc($result);
        
        $content=$profile_array['profile_content'];
        $avatar="http://lorempixel.com/150/150/cats";

?>
 
    <h2> <?php echo $username; 
        
         $following= get_all_following($user_id);
        $bycount=0;
        if(!empty($following)){ 
        foreach($following as $contact){
           $bycount++;
            }
        }
        
        
        $followers= get_all_followers($user_id);
        $count=0;
        if(!empty($followers)){ 
        foreach($followers as $contacting){
           $count++;
            }
        }
        
        ?>  <span class="right"> <a href="friends.php?user=<?php echo $user_id; ?>"><?php echo $count; ?> Followers</a> |  <a href="friends.php?by&user=<?php echo $user_id; ?>"><?php echo $bycount; ?> Following</a></span>
        
        </h2>
       <?php 
        
        $contact=check_if_contact($user_id);
        if(empty($contact)){
            $toggle=1;
            $addremove="Add";
        }else{
            $toggle=0;
            $addremove="Remove";
        }
        
        
    if($user_id!==$_SESSION['user_id']){
    ?>
        <a href="profile.php?contact=<?php echo $toggle; ?>&with=<?php echo $user_id; ?>"><i class="fa fa-user-plus"></i><?php echo $addremove; ?> Contact</a>
    <?php } ?>
    <div id="profile">
       
        <section id="avatar" class="left"> <img src="<?php echo $avatar; ?>" alt="profile image">
         </section>
        <section id="profile-content"> <?php echo $content; ?> </section>
        
        <?php if($addremove=="Remove"){
            //SHOW LATEST POSTS
            echo "Latest Posts";
        
        } ?> 
    </div>

<?php

if($user_id==$_SESSION['user_id']){
    echo "<br/><span class=\"right\"><a href=\"edit_profile.php\"><i class=\"fa fa-pencil\"></i> Edit Profile</a><br/><a title=\"Manage Account Settings\" href=\"settings.php?user=".$_SESSION['user_id'] ."\"><i class=\"fa fa-cog\"></i> Account Settings</a></span><br/>"; 
}
?>
 
  <?php
    }else{
        echo "This user does not exist";
    } ?>
 
        
<?php include("inc/footer.php"); ?>