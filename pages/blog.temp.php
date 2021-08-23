<?php while ($row = mysqli_fetch_array($posts)) { ?>

    <hr>
    <form method="post" action="../database/server.php">
        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">

        <center><h3 class="major"><?php echo $row['title']; ?></h3></center>
        <h4><?php echo $row['category']; ?></h4>


        <small><?php echo date("d-m-Y h:i:sa", strtotime($row['post_date'])) ?></small>

        <span class="image main">
      <?php echo '<img src="data:image;base64,'.$row['image'].' " alt=""/> '; ?>
    </span>

        <input type="submit" value="Read more" class="button special" style="float:right;" name="read"/>
        <br>
    </form>

<?php } ?>
