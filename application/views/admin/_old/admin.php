<h2><?php echo $title; ?></h2>
	
<div id="container">

	<h3><?php echo $subtitle ?>:</h3>

	<ul class="admin-list">
		<?php 
		foreach($items as $item) {
			echo "<li><a href='/admin/{$item}'>{$name}</a></li>";
		}
		?>
	</ul>

</div>