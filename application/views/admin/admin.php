<h2><?php echo $title; ?></h2>
	
<div id="container">
	
	<ul>
		<?php 
		foreach($items as $item=>$name) {
			echo "<li><a href='/admin/{$item}'>$name</a></li>";
		}
		?>
	<ul>	

</div>