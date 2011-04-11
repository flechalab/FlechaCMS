<?php echo validation_errors() ?>

<h2><?php echo $top_title ?></h2>

<div id="container">

	<h3>Manutenção dos Dados da Pagina:</h3>

	<?php echo form_open('admin/pages/' . $id) ?> 
	
	<fieldset>

		<?php
		foreach($form as $item) {
			?>
			<label for="<?php echo $item['id'] ?>"><?php echo $item['title'] ?>*: </label>
			<input type="text" id="<?php echo $item['id'] ?>" name="<?php echo $item['id'] ?>" value="<?php echo set_value($item['id'], $$item['id'])?>" />
			<?php echo form_error($item['id']); ?>
			<br />
			<?php
		}
		?>
		<!--
		<label for="page">ID Página*: </label>
		<input type="text" id="page" name="page" value="<?php echo set_value('page', $page)?>" />
		<?php echo form_error('page'); ?> 
		<br />
		
		<label for="title">Titulo:</label>
		<input type="text" id="title" name="title" value="<?php echo set_value('title', $title)?>" />
		<?php echo form_error('title'); ?> 
		<br />
		
		<label for="header">Cabeçalho:</label>
		<input type="text" id="header" name="header" value="<?php echo set_value('header', $header)?>" />
		<?php echo form_error('header'); ?> 
		<br />
		
		<label for="tooltip">Sumario da Página:</label>
		<input type="text" id="tooltop" name="tooltip" value="<?php echo set_value('tooltip', $tooltip)?>" />
		<?php echo form_error('tooltip'); ?> 
		<br />
		-->
	</fieldset>
	
	<div class="buttons">
		<input type="button" value="Voltar" onclick="Javascript:list_back('pages')" />
			
		<input type="submit" value="Salvar Página" />
		
		<?php if(is_numeric($id)) { ?> 
			<input type="button" value="Excluir Página" onclick="Javascript:page_del(<?php echo $id ?>)" />
		<?php } ?>  
	</div>	
	
	<?php echo form_close() ?> 
	
</div>