<!-- Blog -->
	<article id="post_blog">
		<h2 class="major">Post Content</h2>
		<span class="image main"><img src="../images/work.jpg" alt="" /></span>

		<form method="post" action="../database/server.php" enctype="multipart/form-data">
			<input type="text" name="title" id="title" value="" placeholder="Title" required>

			<br>


			<select name="category" id="category">
				<option value="" disabled selected>Choose Post Category</option>
				<?php foreach($category as $item) { ?>
      				<option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
  				<?php } ?>
			</select>

            <br>

            <center><img id="image_view" src="#" alt="No image" style="display: block" /></center>

            <ul class="actions">
                <li><h3>Image</h3></li>
                <li><input type="file" name="image" accept="image/gif, image/jpeg, image/jpg, image/png" onchange="readURL(this);" class="button special" required></li>
            </ul>


			<br>

			<input type="text" name="link" id="link"  placeholder="Link">

			<br>

			<textarea name="content" id="content" placeholder="Content" rows="6" minlength="20" required></textarea>

			<ul class="actions">
				<!-- <li><a href="#" class="button special icon fa-save">Post</a></li> -->
				<li><input type="submit" name="post" value="Post" class="button special icon fa-save" /></li>
                <li><input type="reset" onclick="reset_post()" name="reset" value="Reset" /></li>
			</ul>
		</form>
        <script>

        </script>
	</article>