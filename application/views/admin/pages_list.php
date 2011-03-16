<h2><?php echo $top_title; ?></h2>

<div class='links-top'>
	<a href="/admin/pages/new">Novo</a>
	<a href="/admin/">Voltar</a>
</div>
	
<div id="container">
	
	<h3><?php echo $title; ?></h3>
	
	<table id="pages-list">
		<thead>
			<tr>
				<th class="id">ID Página</th>
				<th class="title">Titulo</th>
				<th class="header">Cabeçalho</th>
				<th class="content">Conteúdo</th>
				<th class="updated">Atualizado em</th>
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
			echo "<td><a href='/admin/pages/{$item['id']}' title='{$item['tooltip']}'>{$item['page']}</a></td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['title']}</td>"; 
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['header']}</td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td><a href='/admin/pages/{$item['id']}/divs'>Conteudo</a></td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['updated_at']}</td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 3);
			echo "</tr>"; 
			echo chr(10) ;
		}
		?>
		</tbody>
	</table>
	
</div>