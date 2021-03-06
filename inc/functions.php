<?php ob_start();

function redirect_to($new_location) {
    header("Location: " . $new_location);
	  exit; }

function logged_in(){
    return isset($_SESSION['user_id']);
}


function attempt_login($email, $password) {
		$user = find_user_by_email($email);
		if ($user) {
			// found user, now check password
			//if (password_check($password, $user["hashed_password"])) {
            if (password_verify($password, $user["password"])){
				// password matches
				return $user;
			} else {
				// password does not match
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}



function check_password($user_id, $password) {
		$user = find_user_by_id($user_id);
		if ($user) {
			// found user, now check password
			//if (password_check($password, $user["hashed_password"])) {
            if (password_verify($password, $user["password"])){
				// password matches
				return $user;
			} else {
				// password does not match
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}


 
function find_user_by_username($username) {
    global $connection;

    $safe_username = mysqli_real_escape_string($connection, $username);

    $query  = "SELECT * ";
    $query .= "FROM users ";
    $query .= "WHERE username = '{$safe_username}' ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}



function confirm_logged_in(){
    if (!logged_in()){
        redirect_to("login.php");
    }
}	



function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	
 

function find_user_by_id($user_id) {
    global $connection;

    $safe_user_id = mysqli_real_escape_string($connection, $user_id);

    $query  = "SELECT * ";
    $query .= "FROM users ";
    $query .= "WHERE id = {$safe_user_id} ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}


function check_if_contact($user_id) {
    global $connection;

    $safe_user_id = mysqli_real_escape_string($connection, $user_id);

    $query  = "SELECT * ";
    $query .= "FROM contacts ";
    $query .= "WHERE contact_id = {$safe_user_id} AND user_id={$_SESSION['user_id']} ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}

function get_all_following($user_id) {
    global $connection;

    $safe_user_id = mysqli_real_escape_string($connection, $user_id);

    $query  = "SELECT contact_id ";
    $query .= "FROM contacts ";
    $query .= "WHERE user_id={$user_id} ";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
     if($user_set){
        $users=array();
        foreach($user_set as $user){
            array_push($users, $user);
        }
        return $users;
    }else{ return null; }
}



function get_all_followers($user_id) {
    global $connection;

    $safe_user_id = mysqli_real_escape_string($connection, $user_id);

    $query  = "SELECT user_id ";
    $query .= "FROM contacts ";
    $query .= "WHERE contact_id={$user_id} ";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user_set){
        $users=array();
        foreach($user_set as $user){
            array_push($users, $user);
        }
        return $users;
    }else{ return null; }
}

//
//function user_avatar($user_id) {
//    global $connection;
// 
//    $query  = "SELECT * ";
//    $query .= "FROM users ";
//    $query .= "WHERE user_id = '{$user_id}' ";
//    $query .= "LIMIT 1";
//    $user_set = mysqli_query($connection, $query);
//    confirm_query($user_set);
//    if($user = mysqli_fetch_assoc($user_set)) {
//        return $user;
//    } else {
//        return null;
//    }
//}
// $avatar="http://lorempixel.com/150/150/cats";

 


function find_user_by_email($email) {
    global $connection;

    $safe_email = mysqli_real_escape_string($connection, $email);

    $query  = "SELECT * ";
    $query .= "FROM users ";
    $query .= "WHERE email = '{$safe_email}' ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}

 
 
	
?>