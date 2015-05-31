<?php include("inc/header.php");  
    echo "<h1><i class=\"fa fa-comment\"></i> New Post</h1>";

 
if (isset($_POST['submit'])) {
    $content= $_POST['content'];
    $content=addslashes($content);
    $content= htmlentities($content);  
    $date = date('m/d/Y H:i');
    
    if(empty($content)){
        echo "<div class=\"message\">Post cannot be empty!</div>";
    }else{
    
    
        //INSERT ALL DATA EXCEPT PERMISSIONS
    $insert  = "INSERT INTO posts ( user_id, content, datetime) VALUES ( {$_SESSION['user_id']}, '{$content}', '{$date}' ) ";
    $insert_result = mysqli_query($connection, $insert);
    if($insert_result){ 
             
        //INSERT INTO HISTORY
        
            //get post id for link in history content
            $get_post = "SELECT * FROM posts WHERE content='{$content}' AND user_id={$_SESSION['user_id']} ORDER BY id DESC "; 
            $postresult = mysqli_query($connection, $get_post);
            if($postresult){
                $post_found=mysqli_fetch_assoc($postresult);
                $post_id=$post_found['id'];
            }else{
                $post_id="";
            }
         
      
            $_SESSION["message"] = "Post Saved!";
            redirect_to("index.php?"); 
                 
        
                   
        }else{
            $_SESSION["message"] = "post could not be saved";
            redirect_to("index.php");
        }//end insert uery    
        
        }//end make sure no required fields are empty
    }else{

    $content= ""; 
 
}//end check if form was submitted
?>




<!-- NEW post FORM   -->


<form class='add_post' method="POST" >
              
    <textarea  id='content' name="content" placeholder=" Say Something..." value="<?php echo $content; ?>" ><?php echo $content; ?> </textarea>
  
    <input type="submit" name="submit" value="Post"> 
       <a href="index.php" onclick="return confirm('Leave the page? This will not save your post!');"><i class="fa fa-times"></i> Cancel</a> 
               
 </form>
 
 
    
     </div>
        
      
        
<?php include("inc/footer.php"); ?>