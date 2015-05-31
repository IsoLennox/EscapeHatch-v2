<?php include("inc/header.php");  

if(isset($_GET['browse'])){

    //GET ALL POSTS EVER
$post_query  = "SELECT * FROM posts "; 
    $header="Exploring";
    
}elseif(isset($_GET['this'])){

    //GET ALL POSTS EVER
$post_query  = "SELECT * FROM posts WHERE id={$_GET['this']} "; 
    
    //GO BACK TO POST POSITION IN FEED
     if(isset($_GET['browsing'])){$browse="?browse";}else{ $browse="";}
    $header= "<a href=\"index.php".$browse."#".$_GET['this']."\" >&laquo; Back To All Posts</a>";
    
    
}else{

    //ONLY GET POSTS FROM PEOPLE YOU FOLLOW
$post_query  = "SELECT * FROM posts WHERE user_id={$_SESSION['user_id']} ";  
$following= get_all_following($_SESSION['user_id']);
if(!empty($following)){
        foreach($following as $contact){
                $post_query.="OR user_id={$contact['contact_id']} ";
            }
        }
    
    $header="Your Feed";
    
}
    $post_query.="ORDER BY id DESC";
    $post_result = mysqli_query($connection, $post_query);
    if($post_result){
        
         echo "<h1>$header</h1>";
        
        
        //show each result value
        foreach($post_result as $show){
            echo "<div id=\"".$show['id']."\" class=\"post_container\">";
            //GET USERNAME  
            $find_user = find_user_by_id($show['user_id']); 
            echo "<a href=\"profile.php?user={$show['user_id']}\"><img class=\"thumbnail\" src=\"".$find_user['avatar']."\" onerror=\"this.src='http://lorempixel.com/150/150/cats'\" /> ".$find_user['username']."<br/>".$show['datetime']."<Br/></a>"; 
             
            echo "<br/>".$show['content']; 
            echo "<br/><hr/>";
            if(isset($_GET['browse'])){$browse="&browsing";}else{ $browse="";}
            echo "<span class=\"post_interactions\"><i class=\"fa fa-heart\"></i> # <span class=\"right\"><a href=\"index.php?this={$show['id']}".$browse."\">  # Comments</a></span></span>"; 
               
               if(isset($_GET['this'])){ 
                   //SHOW ALL COMMENTS
                   ?>
                   
                <form class="comments" action="#" method="POST"  >
                    <input type="text" name="comment" placeholder="Say something...">
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="fa fa-envelope-o"></i> 
                    </button>
                </form>
            <?php }
            echo "</div>";
                      
            }
        }
include("inc/footer.php"); ?>