
<div id="container-admin">

	<ul class="admin-list">
		<?php
		foreach($items as $item) {
			echo "<li><a href='{$uri}/{$item['id']}' title='{$item['tooltip']}'>";
            echo "{$item['desc']}</a></li>";
		}
		?>
	</ul>

</div>

