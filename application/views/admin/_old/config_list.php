<h2><?php echo $top_title; ?></h2>

<div class='links-top'>
	<a href="/admin/config/new">Novo</a>
	<a href="/admin/">Voltar</a>
</div>

<div id="container">

	<h3><?php echo $title; ?></h3>

	<table id="config-list">
		<thead>
			<tr>
				<th class="config">Configuração</th>
				<th class="value">Valor</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach($items as $item) {
			echo chr(10);
			echo str_repeat(chr(9), 3);
			echo "<tr>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td><a href='/admin/config/{$item['config']}'>{$item['config']}</a></td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['value']}</td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "</tr>";
			echo chr(10) ;
		}
		?>
		</tbody>
	</table>

</div>