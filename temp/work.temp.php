<!-- Work -->
<article id="work">
    <h2 class="major">Work</h2>
    <span class="image main"><img src="../images/work.jpg" alt="" /></span>
    <!--		<p>I appreciate your interest! I am Currently <strong>Trying to Host</strong> all my projects. Please visit again soon.</p>-->
    <p>These are some of my <strong>Hard worked</strong> projects! Please view my Github <strong><a href="https://github.com/tanveer6334?tab=repositories" target="_blank">Source Code</a></strong> for more!</p>

    <!--        <h1> Need to upload project first!</h1>-->
    <?php
    //$query = "SELECT * FROM project";
    //$result = $crud->getData($query);
    //while ($row = mysqli_fetch_array($projects)) {
    $result = $crud->show('project');
    foreach ($result as $key => $row) :
        ?>

        <hr>
        <center><h3 class="major"><?php echo $row['title']; ?></h3></center>
        <h4><?php echo "Category: <strong>". $row['category']."</strong>" ; ?></h4>
        <small><?php echo "Posted at: ". date("d-m-Y h:i:sa", strtotime($row['post_date'])) ?></small>

        <span class="image main">
                <?php echo '<img src="data:image;base64,'.$row['image'].' " alt=""/> '; ?>
            </span>

        <h5><?php echo "Summary: ". $row['summary']; ?></h5>
        <p><?php echo "Description: ". $row['description']; ?></p><br>
        <h4>Features:</h4>
        <ul>
            <?php
            $features = explode("\n", $row['features']);
            //  var_dump($features);
            foreach($features as $feature){
                echo '<li>'.$feature.'</li>';

            }
            ?>
        </ul>

        <a href="<?php echo $res['link']; ?>" target="_blank">
            <input type="submit" value="Source Code" class="button special" style="float:right;" name="read"/>
        </a>
        <br>
    <?php endforeach; ?>
    <br>
    <p>You might want to check out my <a href="#about"><strong>Biography</strong></a>.</p>
</article>
