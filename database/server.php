<?php
    // Import Connection database
    require 'db.php';
	include_once 'classes/Crud.php';
	include_once 'classes/Validation.php';

	session_start();
	// Initialize variables
	$name = "";
	$email = "";
	$message = "";
	$id = 0;
	$edit_state = false;

	$title = "";
	$category = "";
	$image_name = "";
	$link = "";
	$content = "";
	$post_date = "";

	$crud = new Crud();
	$validation = new Validation();

	// Contact page(Send Button)
	if (isset($_POST['send'])) {
        $name = $crud->escape_string($_POST['name']);
        $email = filter_var($crud->escape_string($_POST['email']), FILTER_SANITIZE_EMAIL);
        $message = $crud->escape_string($_POST['message']);
        $post_date = date("Y-m-d H:i:s");

        if ($msg != null) {
        	echo $msg;
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}
		else {
            //$query = "INSERT INTO message (name, email, message, post_date) VALUES ('$name', '$email', '$message', '$post_date')";
        	//$result =$crud->execute($query);
			$result = $crud->insert( 'message','name, email, message, post_date', "'$name', '$email', '$message', '$post_date'");
		}

//		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
//		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
//		$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
//        $post_date = date("d-m-Y H:i:sa");

//		$query = "INSERT INTO message (name, email, message, post_date) VALUES ('$name', '$email', '$message', '$post_date')";


		//mysqli_query($db, $query);

		$_SESSION['msg'] = "Message Sent!";
		//echo "Message Sent!";
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		header('location: '.str_replace("database/server.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."index.php#contact");

	}


	// post_blog(Post button)
	if(isset($_POST['post'])) {

        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);

        $image = addslashes($_FILES['image']['tmp_name']); //SQL Injection defence!
        $image_name = addslashes($_FILES['image']['name']);
        $image = file_get_contents($image);
        $image = base64_encode($image);

        $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $post_date = date("d-m-Y H:i:s");

        //$query = "INSERT INTO post_blog (title, category, image, image_name, link, content, post_date) VALUES ('$title', '$category', '$image', '$image_name', '$link', '$content', '$post_date')";
        //mysqli_query($db, $query);
		$result = $crud->insert('post_blog', 'title, category, image, image_name, link, content, post_date', "'$title', '$category', '$image', '$image_name', '$link', '$content', '$post_date'");
		if(!$result){
			$_SESSION['msg'] = "ERROR in posting Blog";
		}
        $_SESSION['msg'] = "Blog has been post!";

        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        header('location: '.str_replace("database/server.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."index.php#blog");

	}

	// show_blog(view)
	if(isset($_GET['read'])) {
		$id = $_GET['read'];
		$edit_state = true;
		//$rec = mysqli_query($db, "SELECT * FROM post_blog WHERE id=$id");
		//$record = mysqli_fetch_array($rec);
		$result = $crud->search('post_blog', 'id', $id);

		$title = $_POST['title'];
		$category = $_POST['category'];
		$image = '<img src="data:image;base64,'.$_POST['image'].' " alt=""/> ';
		$link = $_POST['link'];
		$content = $_POST['content'];
		$post_date = date("d-m-Y H:i:sa",  strtotime($row['post_date']));
	}

	// Blog(Read button)
	if(isset($_POST['read'])) {

		$id = $_POST['id'];

		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		header('location: '.str_replace("database/server.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."#show_blog");

	}

	// Post_project(post_project button)
	if(isset($_POST['post_project'])) {
		try {
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);

            $image = addslashes($_FILES['image']['tmp_name']); //SQL Injection defence!
            $image_name = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);

            $summary = filter_var($_POST['summary'], FILTER_SANITIZE_STRING);
        	$features = filter_var($_POST['features'], FILTER_SANITIZE_STRING);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);

            $post_date = date('Y-m-d H:i:s');

            //$query = "INSERT INTO project (title, category, image, image_name, summary, description, features, link, post_date) VALUES ('$title', '$category', '$image', '$image_name', '$summary', '$description', '$features', '$link', 'NOW()')";

			//echo $query;
            //$result = mysqli_query($db, $query);
            //echo $result;

			$result = $crud->insert('project', 'category, image, image_name, summary, description, features, link, post_date', "'$title', '$category', '$image', '$image_name', '$summary', '$description', '$features', '$link', '$post_date");

            if(!$result) {
            	echo 'problem insertion<br>';
            	echo mysqli_error($db);
			}

            $_SESSION['msg'] = "Project has been posted!";

            $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            //header('location: '.str_replace("database/server.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."");
            header('location: '.str_replace("database/server.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."index.php#work");
		}
		catch (Exception $exception){
			echo 'SQL Insert Error!';
			echo $exception->getMessage();
		}
	}


//	$id = "";
//	$title = "";
//	$image = "";
//	$category = "";
//	$content = "";

	// show_blog(id=?)

//    if(isset($_GET['id'])) {
//        $id = $_GET['id'];
//        $articles = mysqli_query($db, "SELECT * FROM post_blog WHERE id=$id");
//
//        $article = mysqli_fetch_array($articles);
//        $title = $article['title'];
//
//        // $title = $article['title'];
//        $category = $article['category'];
//        $image = $article['image'];
//        $link = $article['link'];
//        $content = $article['content'];
//        // $post_date = date("Y-m-d H:i:s");
//        //echo $id." Done";
//    }


?>
