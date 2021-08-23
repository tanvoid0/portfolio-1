<!-- Work -->
	<article id="work">
		<h2 class="major">Work</h2>
		<span class="image main"><img src="./images/work.jpg" alt="" /></span>
<!--		<p>I appreciate your interest! I am Currently <strong>Trying to Host</strong> all my projects. Please visit again soon.</p>-->
        <p>These are some of my <strong>Hard worked</strong> projects! Please view my Github <strong><a href="https://github.com/tanveer6334?tab=repositories" target="_blank">Source Code</a></strong> for more!</p>
				<hr>
        <?php
            $result = $crud->show('project');
            foreach ($result as $key => $row) :
        ?>
        <div class="w3-card-4 w3-margin w3-dark-grey">
						<!-- <div class="w3-container"> -->
							<!-- <br> -->
            	<?php echo '<img src="data:image;base64,'.$row['image'].' " alt="" style="width:100%;"/> '; ?>
						<!-- </div> -->
            <div class="w3-container">
                <h3><b><?php echo $row['title']; ?></b></h3>
                <h5><?php echo $row['category'] ;?>, <span class="w3-opacity"><?php echo date('l, F d y h:i:s a', strtotime($row['post_date'])) ?></span></h5>
            </div>

            <div class="w3-container">
                <h6><?php echo "<strong>Summary:</strong> ". $row['summary']; ?></h6>
                <p><?php echo "<strong>Description:</strong> ". $row['description']; ?></p><br>
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
                <div class="w3-row">
                    <div class="w3-col m8 s12">
                        <!-- <a href="<?php //echo $res['link']; ?>" target="_blank">
                            <p><button class="w3-button w3-padding-large w3-dark-grey w3-black"><b>READ MORE »</b></button></p>
                        </a> -->
												<input type="reset" onclick="window.open('<?php echo $row['link']; ?>');" name="source_code" value="View Source Code" />
											</div>
                </div>
								<br>
            </div>
        </div>
        <hr>
        <?php endforeach; ?>
        <br>
        <p>You might want to check out my <a href="#about"><strong>Biography</strong></a>.</p>
	</article>
