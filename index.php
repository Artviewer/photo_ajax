<!DOCTYPE html>
<html>
    <head>
	<link rel="icon" href="/favicon.ico"/>
        <meta charset="UTF-8">
        <title>Gallery</title>

	<link href="css/main.css" rel="stylesheet" type="text/css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	
    </head>
    <body>
	<form id='photo' action="addphoto.php" method='post' enctype='multipart/form-data'>
	    <input type="file" name="photo">
	    <input type="submit">
	</form>
	<div class="gallery"></div>
    </body>
</html>
