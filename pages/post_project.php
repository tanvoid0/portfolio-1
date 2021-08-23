<!-- Blog -->
<article id="post_project">
    <?php if($_SESSION['login'] == "true"): ?>
    <h2 class="major">Post Project Content</h2>
    <span class="image main"><img src="../images/work.jpg" alt="" /></span>

    <form method="post" action="../database/server.php" enctype="multipart/form-data">
        <!--Title-->
        <input type="text" name="title" id="title" value="" placeholder="Title" required>
        <br>

        <!--Category-->
        <select name="category" id="category">
            <option value="" disabled selected>Choose Project Category</option>
            <?php if (isset($project_type)) {
                foreach($project_type as $item) { ?>
                    <option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
                <?php }
            } ?>
        </select>
        <br>

        <!--Image View-->
        <center><img id="image_view" src="#" alt="No image" style="display: block" /></center>

        <ul class="actions">
            <li><h3>Image</h3></li>
            <li><input type="file" name="image" accept="image/gif, image/jpeg, image/jpg, image/png" onchange="readURL(this);" class="button special" required></li>
        </ul>
        <br>

        <!--Summary-->
        <input type="text" name="summary" id="summary"  placeholder="Summary">
        <br>

        <!--Features-->
        <textarea id="features" name="features" placeholder="Features" rows="6" minlength="20"></textarea>
        <br>

        <!--Description-->
        <textarea id="description" name="description" placeholder="Description" rows="6" minlength="20"></textarea>
        <br>

        <input type="url" name="link" id="link"  placeholder="Link">
        <br>
        <ul class="actions">
            <!-- <li><a href="#" class="button special icon fa-save">Post</a></li> -->
            <li><input type="submit" name="post_project" id="post_project" value="Post Project" class="button special icon fa-save" /></li>
            <li><input type="reset" onclick="reset_post()" name="reset" value="Reset" /></li>
        </ul>
    </form>
    <?php
        else:
            echo "Please Login to <a href='../boss/'>Admin Panel</a> first";
        endif
    ?>
</article>