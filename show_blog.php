

<?php
require 'database/db.php';
include 'database/var.php';

$id = "";
$title = "";
$image = "";
$category = "";
$content = "";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $articles = mysqli_query($db, "SELECT * FROM post_blog WHERE id=$id");
    $article = mysqli_fetch_array($articles);

    $title = $article['title'];
    $category = $article['category'];
    $image = $article['image'];
    $link = $article['link'];
    $content = $article['content'];
    $post_date = date("Y-m-d H:i:sa", strtotime($article['post_date']));
}

?>

<?php include 'includes/header.php'; ?>





<!-- Blog -->

<div id="wrapper">
    <div class="boxed">
        <article>

            <center><h3 class="major"><?php echo $title; ?></h3></center>
            <?php echo "<p>Posted on: $post_date </p>" ; ?>
            <h4><?php echo $category; ?></h4>
            <span class="image main">
					<?php echo '<img src="data:image;base64,'.$image.' " alt=""/> '; ?>
				</span>
            <!-- <button onclick="location.href='.<?php echo $link;?>'">LINK</button> -->
            <form action="<?php echo $link;?>">
                <input type="submit" value="Follow Link" />
            </form>
            <p><?php echo $content; ?> </p>

            <a href="index.php#blog" class="button small">Back</a>
            <br>
        </article>
    </div>
</div>

<?php include 'includes/footer.php'; ?>