<?php include("inc/header.php");  



    $query  = "SELECT * FROM posts";  
    $result = mysqli_query($connection, $query);
    if($result){
        //show each result value
        foreach($result as $show){
            echo "<div class=\"post_container\">";
            echo $show['user_id']; 
            echo $show['datetime']; 
            echo $show['content']; 
            echo "</div>";
                      
            }
        }
 ?>
    
 
        
      
        
<?php include("inc/footer.php"); ?>