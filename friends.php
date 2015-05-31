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
   
} ?>

    
    
    
    
    

    <h2> <?php if(isset($_GET['by'])){
    //GET WHO THIS USER IS FOLLOWING
    echo " Followed By <a href=\"profile.php?user={$user_id}\">".$username."</a> ";
}else{
    echo " <a href=\"profile.php?user={$user_id}\">".$username."</a>'s Followers ";
}
        
//GET COUNTS
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
        
        ?><span class="right"> <a href="friends.php?user=<?php echo $user_id; ?>"><?php echo $count; ?> Followers</a> |  <a href="friends.php?by&user=<?php echo $user_id; ?>"><?php echo $bycount; ?> Following</a></span>
        
        </h2>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
<?php
if(isset($_GET['by'])){
    //GET WHO THIS USER IS FOLLOWING 
     $contacts= get_all_following($user_id);
    if(!empty($contacts)){
        
        
        foreach($contacts as $contact){ 
           $user_id=$contact['contact_id'];
            $user=find_user_by_id($user_id);
            echo "<a href=\"profile.php?user={$user_id}\"><img class=\"thumbnail\" src=\"".$user['avatar']."\" onerror=\"this.src='http://lorempixel.com/150/150/cats'\" /> ".$user['username']."</a>";

            $contact=check_if_contact($user_id);
            if(empty($contact)){
                $toggle=1;
                $addremove="Add";
            }else{
                $toggle=0;
                $addremove="Remove";
             }   ?>
            <a class="right" href="profile.php?contact=<?php echo $toggle; ?>&with=<?php echo $user_id; ?>"><i class="fa fa-user-plus"></i><?php echo $addremove; ?> Contact</a>
           <?php echo "<hr/><br/>";
        }
    }else{
        echo "This user is not following anyone!";
    }
    
}else{
    //GET FOLLOWERS OF THIS USER 
     $contacts= get_all_followers($user_id);
    if(!empty($contacts)){
        foreach($contacts as $contact){ 
            $user_id=$contact['user_id'];
            $user=find_user_by_id($user_id);
            echo "<a href=\"profile.php?user={$user_id}\"><img class=\"thumbnail\" src=\"".$user['avatar']."\" onerror=\"this.src='http://lorempixel.com/150/150/cats'\" /> ".$user['username']."</a>";

            $contact=check_if_contact($user_id);
            if(empty($contact)){
                $toggle=1;
                $addremove="Add";
            }else{
                $toggle=0;
                $addremove="Remove";
            }   ?>
            <a class="right" href="profile.php?contact=<?php echo $toggle; ?>&with=<?php echo $user_id; ?>"><i class="fa fa-user-plus"></i><?php echo $addremove; ?> Contact</a>
           <?php echo "<hr/><br/>";
        }
    }else{
        echo "This user is not being followed by anyone!";
    }

}

 
?>
 
        
<?php include("inc/footer.php"); ?>