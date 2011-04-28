<h2><?php echo $top_title; ?></h2>

<div class='links-top'>
	<a href="/admin/users/new">Novo</a>
	<a href="/admin/">Voltar</a>
</div>
	
<div id="container">
	
	<h3><?php echo $title; ?></h3>
	
	<table id="users-list">
		<thead>
			<tr>
				<th class="user">Usuário</th>
				<th class="name">Nome</th>
				<th class="mail">Email</th>
				<th class="active">Ativo</th>
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
			echo "<td><a href='/admin/users/{$item['id']}'>{$item['user']}</a></td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['name']}</td>"; 
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td>{$item['mail']}</td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 4);
			echo "<td><a href='/admin/users/{$item['id']}/active'>Active</a></td>";
			echo chr(10) ;
			echo str_repeat(chr(9), 3);
			echo "</tr>"; 
			echo chr(10) ;
		}
		?>
		</tbody>
	</table>
	
</div>