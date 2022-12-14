<?php
	session_start();
	require_once 'conn.php';
 	
	//Support Functions
	//----------------------------------
	function checkLogin()
	{
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    		header("location: signin.php");
    		exit;
		}
	}

 	//Login Function
 	//------------------------------------------
 	if(isset($_POST['login'])){
		if($_POST['username'] != "" || $_POST['password'] != ""){


			$username = $_POST['username'];
			$password = $_POST['password'];


			$sql = "SELECT * FROM `User` WHERE `username`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($username,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				 // Store data in session variables
				$_SESSION['user'] = $fetch['userId'];
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;
				header("location: index.php");
			} else{
				echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = 'signin.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
		}
	}
		////Admin
	if(isset($_POST['adminlogin'])){
		if($_POST['username'] != "" || $_POST['password'] != ""){


			$username = $_POST['username'];
			$password = $_POST['password'];


			$sql = "SELECT * FROM `Admin` WHERE `username`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($username,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['user'] = $fetch['adminId'];
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;
				header("location: admin.php");
			} else{
				echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = 'adminlogin.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
		}
	}
	//------------------------------------------------

	//Register Function
	if(ISSET($_POST['register'])){
		if($_POST['firstname'] != "" || $_POST['lastname'] != "" || $_POST['username'] != "" || $_POST['password'] != ""){
			try{
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$username = $_POST['username'];
				// md5 encrypted
				// $password = md5($_POST['password']);
				$password = $_POST['password'];

				// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO User VALUES(userId, '$firstname', '$lastname', '$username', '$password')";
				$insertion=$conn->prepare($sql);
				$insertion->execute();

			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
			$conn = null;
			echo "
				<script>alert('User Added')</script>
				<script>window.location = 'signin.php'</script>
			";
			
		}else{
			echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'pms.php'</script>
			";
		}
	}


if (isset($_POST['borrow'])) {
            checkLogin();
            //Check the user *** Buggy
           
             function getBookTitle($conn, $sql1, $parameters)
				{
				    $q = $conn->prepare($sql1);
				    $q->execute($parameters);
				    return $q->fetchColumn();

				}
            if(isset($_POST['checkbox'])){
            	$username=$_SESSION['username'];
            $checked = $_POST['checkbox'];
            for($i=0; $i < count($checked); $i++){
            	$sql1 = " SELECT title FROM Publisher WHERE pId = ? ";

            	

                $id = $checked[$i];

				$title=getBookTitle($conn,$sql1,[$id]);
			$sql2 = " INSERT INTO borrows VALUES (id,current_timestamp(), '$title', '$username' )";
                $query = $conn->prepare($sql2);
                $query->execute();
                
                if ($query==true) {
                    echo "<script>alert('Book(s) Borrowed')</script>";
                }
            }
            }else{
            	echo "<script>alert('Please select what to borrow')</script>
            	<script>window.location='index.php'</script>";
            }
            echo "<script>window.location = 'index.php'</script>";
            
        
}

	if (isset($_POST['delete'])) {
		echo "Delete Working1";
	}

	if (isset($_POST['search'])) {
		echo "Search Working1";
	}
?>