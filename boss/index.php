<?php
    require_once '../database/geoplugin/geoplugin.class.php';
    include_once '../database/classes/Crud.php';

    include '../database/server.php';
    include '../database/var.php';
    include '../database/iptracker.php';
    include "../database/geofile.php";

    $crud = new Crud();
    $read = -1;
    $reply = false;
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ( empty( $_SESSION['login'] )) {
       $_SESSION['login'] = "";
    }

    // Reply button, Send mail page
    if(isset($_GET['reply'])){
        $reply = $_GET['reply'];
    }

    // Testing, send mail button if reply pressed
    if(isset($_POST['mail'])) {
        $to = $_GET['to'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $headers = 'From: mcruze14@google.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        $_SESSION['msg'] = "Mail Sent";

        //header('location: index.php');

    }

    // Delete a message
    if(isset($_GET['del'])){
        $del = $_GET['del'];
        //$query = "DELETE FROM message WHERE id='$del'";
        //mysqli_query($db, $query) or die("Delete error!");
        $result = $crud->delete($del, 'message');

        $_SESSION['msg'] = "Message deleted!";

        header('location: index.php');
    }

    if(isset($_GET['message'])) {
        $id = $_GET['message'];
        //$query = "SELECT * FROM message WHERE id='$read'";
        //$message = mysqli_query($db, $query) or die("Message Read error!");
        //$message = mysqli_fetch_array($message);
        $message = $crud->search('message','id', $id);
        if(!$message){
            $_SESSION['msg'] = 'Problem reading Message';
        }
        $_SESSION['msg'] = "Message Opened!";
    }

    // Log out button pressed
    if(isset($_POST['logout'])){
        $_SESSION['login'] = "";
    }

    // Login button pressed
    if(isset($_POST['login'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];

        $query = "SELECT * FROM admin WHERE name='$user'";

        $user = mysqli_query($db, $query);

        if($user->num_rows == 0) {
            $_SESSION['msg'] = "No User Found!";
        }
        else {
            $user = mysqli_fetch_array($user);

            $name = $user['name'];
            $password = $user['password'];
            if($password == $user['password']){
                $_SESSION['login'] = "true";
            }
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<!-- meta import -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

	<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>

<!-- tab icon import -->
	<link rel="shortcut icon" type="image/x-icon" href="../../blog2/images/icon.ico" />

	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
</head>
<body>
    <div class="table-wrapper login-wrapper">
        <h1 style="text-align: center;">Welcome to <a href="../">ADMIN</a> Panel</h1>
        <div style="text-align: center;">
        <?php
            if(get_client_ip() == "127.0.0.1"){
                echo "<h4>You are on Localhost</h4>";
            }
            else {
                $query = "SELECT * FROM log WHERE admin_ip='$ip'";
                $result = mysqli_query($db, $query);
                if (!$result): ?>
                    <h4>New Location detected!</h4>
                <?php endif ?>

                <?php
                echo "<h4> Your IP is: ".$ip."</h4>";
                echo "<h5>City: ".$city."<br>";
                echo "Region: ".$region."<br>";
                echo "Country: ".$country."<br>";
                echo "Status: ".$continent[$continent_code]."</h5>";
            }
            ?>
        </div>

        <?php if (isset($_SESSION['msg'])): ?>
			<body onload = "setTimeout()">
            <div style="margin: 30px auto; padding: 10px; border-radius: 5px; color: #3c763d; background: #dff0d8; border: 1px solid #3c763d; width: 50%;text-align: center;" id="msg">
                <?php
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                ?>
            </div>
		<?php endif ?>

        <?php if($_SESSION['login'] == "") : ?>
            <div class="action login-form">
                <form method="post" action="index.php">
                    <input type="text" name="user" id="user" placeholder="User"/>
                    <input type="password" name="password" id="password" placeholder="Password"/>
                    <input type="submit" class="submit-btn" id="login" name="login" value="Login"/>
                </form>
            </div>
<!--            <div style="padding: 20px"> <iframe src="../fireworks/" width="600" height="400" style="position: absolute; left: 50%; margin: 0 0 0 -300px;"></iframe> </div>-->


        <?php else: ?>
            <?php if($read == -1) : ?>
                <form method="post" action="index.php" style="float: right; padding-right: 20px;">
                    <input type="submit" id="logout" name="logout" value="Log Out"/>
                </form>
                <table class="alt">
                    <thread>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Messages</th>
                            <th>Time</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php
                            //$query = "SELECT * FROM message";
                            //$result = $crud->getData($query);
                            $result = $crud->show('message');
                            foreach ($result as $key => $row):
                        //while ($row = mysqli_fetch_array($results)) {
                        ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['message']; ?></td>
                                <td><?php echo date("d-m-Y h:i:sa", strtotime($row['post_date'])); ?></td>
                                <td>
                                    <a class="edit_btn" href="index.php?message=<?php echo $row['id']; ?>">Read</a>
                                </td>
                                <td>
                                    <a class="del_btn" href="index.php?del=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>

                <h2> Name: <?php echo $message['name']; ?></h2>
                <h3> Email: <?php echo $message['email']; ?> </h3>
                <strong> Sent Date: <?php echo date("d-m-Y H:i:sa", strtotime($message['post_date'])) ; ?></strong>
                <br>
                <br>
                <p>Message:</p>
                <p><?php echo $message['message']; ?> </p>
                <form method="post" action="<?php echo $actual_link."&reply=true";?>" style="float: left; padding-left: 20px;">
                    <input type="submit" id="reply" name="reply" value="Reply"/>
                </form>
                <form method="post" action="index.php" style="float: right; padding-right: 20px;">
                    <input type="submit" id="back" name="back" value="Back to Inbox"/>
                </form>

                <?php if($reply): ?>
                    <br>
                    <br>
                    <br>
                    <form method="post" action="index.php?to=<?php echo $message['email']; ?>">
                        <h3 style="float: left;">To: <?php echo $message['email']; ?></h3>
                        <input type="text" name="subject" id="subject" value="" placeholder="Subject" required>

                        <br><br>
                        <div class="field">
                            <!--				<label for="message">Message</label>-->
                            <textarea name="message" id="message" rows="4" placeholder="Message"></textarea>
                        </div>
                        <ul class="actions">

                            <li><input type="submit" id="mail" name="mail" value="Send Mail" class="special" /></li>
<!--                            <li><input type="reset" onclick="reset()" name="reset" value="Reset" /></li>-->
                        </ul>
                    </form>
                <?php endif?>
            <?php endif ?>
            <form method="post" action="../#post_project" style="padding: 20px;">
                <input type="submit" id="logout" name="logout" value="Submit Project!"/>
            </form>
        <?php endif?>
	</div>

	<!-- Message Hider -->
			<script src="../assets/js/js.js"></script>
</body>
</html>
