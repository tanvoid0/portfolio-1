<!-- Wrapper -->
<div id="wrapper">
    <!-- Loader -->
    <div class="se-pre-con"></div>


    <!-- Database message 	 -->
    <?php if (isset($_SESSION['msg'])): ?>
    <body onload = "setTimeout()">
    <div style="margin: 30px auto; padding: 10px; border-radius: 5px; color: #3c763d; background: #dff0d8; border: 1px solid #3c763d; width: 50%;text-align: center;" id="msg">
        <?php
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        ?>
    </div>
    <?php endif ?>

    <!-- Header -->
    <header id="header">
        <div class="logo">
            <span class="icon fa fa-rocket"></span>
        </div>
        <div class="content">
            <div class="inner">
                <h3>Hi! I am</h3>
                <h1>Tanveer Hoque</h1>
                <p>I'm A programmer & Web Developer!</p>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#intro">Intro</a></li>
                <li><a href="#work">Work</a></li>
<!--                <li><a href="#blog">Blog</a></li>-->
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <!-- <li><a href="#elements">Elements</a></li> -->
            </ul>
        </nav>
        <div class="actions">
            <a href="#contact" class="button special icon fa fa-user-plus">Hire Me!</a>
        </div>
    </header>
    <!-- Main -->
    <div id="main">

        <?php
        include 'intro.php';
        include 'work.php';
        include 'blog.php';
        include 'post_blog.php';
        include 'post_project.php';
        include 'about.php';
        include 'contact.php';
        include 'elements.php';
        ?>
					