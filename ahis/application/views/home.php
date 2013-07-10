<html>
<head>
	<title></title>
</head>
<body>

	<div id="container">

		<p>My view has been loaded</p>
		
		<?php
		foreach ($rows as $r) {
			echo '<h1>'.$r->ID.'</h1>';
		 	# code...
		 } 
		 ?>

		


	</div>

</body>
</html>