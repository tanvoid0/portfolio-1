<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Canvas Fireworks</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">


      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      html, body {
	margin: 0;
	padding: 0;
}

body {
	background: #171717;
	color: #999;
	font: 100%/18px helvetica, arial, sans-serif;
}

a {
	color: #2fa1d6;
	font-weight: bold;
	text-decoration: none;
}

a:hover {
	color: #fff;
}

#canvas-container {
	background: #000 url(https://jackrugile.com/lab/fireworks-v2/images/bg.jpg);
  height: 400px;
	left: 50%;
	margin: -200px 0 0 -300px;
	position: absolute;
	top: 50%;
  width: 600px;
	z-index: 2;
}

canvas {
	cursor: crosshair;
	display: block;
	position: relative;
	z-index: 3;
}

canvas:active {
	cursor: crosshair;
}

#skyline {
	background: url(https://jackrugile.com/lab/fireworks-v2/images/skyline.png) repeat-x 50% 0;
	bottom: 0;
	height: 135px;
	left: 0;
	position: absolute;
	width: 100%;
	z-index: 1;
}

#mountains1 {
	background: url(https://jackrugile.com/lab/fireworks-v2/images/mountains1.png) repeat-x 40% 0;
	bottom: 0;
	height: 200px;
	left: 0;
	position: absolute;
	width: 100%;
	z-index: 1;
}

#mountains2 {
	background: url(https://jackrugile.com/lab/fireworks-v2/images/mountains2.png) repeat-x 30% 0;
	bottom: 0;
	height: 250px;
	left: 0;
	position: absolute;
	width: 100%;
	z-index: 1;
}

#gui {
	right: 0;
	position: fixed;
	top: 0;
	z-index: 3;
}
    </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>


  <div id="gui"></div>
<div id="canvas-container">
  <div id="mountains2"></div>
  <div id="mountains1"></div>
  <div id="skyline"></div>
</div>
<!-- <a href="../" >Back</a> -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://jackrugile.com/lab/fireworks-v2/js/dat.gui.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>
