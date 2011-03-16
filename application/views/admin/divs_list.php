<h2><?php echo $top_title; ?></h2>

<div class='links-top'>
	<a href="/admin/pages/<?php echo $page_id ?>/divs/new">Novo</a>
	<a href="/admin/pages/">Voltar</a>
</div>

<div id="container">

	<h3><?php echo $title; ?></h3>

	<table id="divs-list">
		<thead>
			<tr>
				<th class="id">ID Div</th>
				<th class="type">Tipo</th>
				<th class="title">Titulo</th>
				<th class="image">Imagem</th>
				<th class="link">Link</th>
				<th class="updated">Atualizado em</th>
			</tr>
		</thead>
		<tbody>
		<?php  
		foreach($items as $item) {
			echo chr(10);
			echo str_repeat(chr(9), 3);
			echo "<tr>";
			echo chr(10);
			echo str_repeat(chr(9), 4);
			echo "<td><a href='/admin/pages/{$page_id}/divs/{$item['id']}'>{$item['div_id']}</a></td>";
			echo chr(10);
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['div_type']}</td>";
			echo chr(10);
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['div_title']}</td>";
			echo chr(10);
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['div_img']}</td>";
			echo chr(10);
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['div_url']}</td>";
			echo chr(10);
			echo str_repeat(chr(9), 3);
			echo "<td>{$item['updated_at']}</td>";
			echo chr(10);
			echo str_repeat(chr(9), 3);
			echo "</tr>";
			echo chr(10); 
		}
		?>
		</tbody>
	</table>
	
</div>