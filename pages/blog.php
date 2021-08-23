<!-- Blog -->
<article id="blog">
    <h2 class="major">Blog</h2>
    <span class="image main"><img src="../images/article.jpg" alt="" /></span>

    <a href="#post_blog" class="button special icon fa-save">Post Your Article!</a>

        <?php
            //$query = "SELECT * FROM post_blog ORDER BY id DESC";
            $result = $crud->show('post_blog');
            foreach ($result as $key => $row) { ?>

            <form method="post" action="../database/server.php">
              <div class="w3-card-4 w3-margin w3-dark-grey">
                <?php echo '<img src="data:image;base64,'.$row['image'].' " alt="" style="width:100%;"/> '; ?>
                <!-- <span class="image main">
                    <img src=<?php //echo "data:image;base64,'.$row['image'].' ";?> alt="No Image" style="width:100%">
                </span> -->
                <!-- <img src="data:image;base64,"<?php //$row['image']."";?> alt="No Image" style="width:100%"> -->
                <div class="w3-container">
                  <h3><b><?php echo $row['title'] ;?></b></h3>
                  <h5><?php echo $row['category'] ;?>, <span class="w3-opacity"><?php echo date('l, F d y h:i:s a', strtotime($row['post_date'])) ?></span></h5>
                </div>

                <div class="w3-container">
                  <p><?php echo $row['content']; ?></p>
                  <div class="w3-row">
                    <div class="w3-col m8 s12">
                      <p><button class="w3-button w3-padding-large w3-dark-grey w3-black"><b>READ MORE »</b></button></p>
                    </div>
                    <!-- <div class="w3-col m4 w3-hide-small">
                      <p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-tag">0</span></span></p>
                    </div> -->
                  </div>
                </div>
              </div>
              <hr>

                <!-- <center><h3 class="major"><?php //echo $row['title']; ?></h3></center>
                <h4><?php //echo $row['category']; ?></h4>
                <small><?php //echo date("d-m-Y h:i:sa", strtotime($row['post_date'])) ?></small> -->

                    <?php //echo '<img src="data:image;base64,'.$row['image'].' " alt="" style="width:100%;"/> '; ?>

                <!-- <input type="submit" value="Read more" class="button special" style="float:right;" name="read"/><br> -->
        <?php  } ?>
    </form>



</article>
