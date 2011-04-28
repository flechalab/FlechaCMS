<?php echo validation_errors() ?>

<h2><?php echo $top_title ?></h2>

<div id="container">

	<h3><?php echo $title ?></h3>

	<fieldset>
	
		<?php echo form_open('admin/pages/' . $id_page . '/divs/' . $id) ?>
	
		<label for="page">ID Div*: </label> 
		<input type="text" id="div_id" name="div_id" value="<?php echo set_value('div_id', $div_id)?>" />
		<?php echo form_error('div_id'); ?>
		<br />
		
		<label for="title">Tipo*:</label> 
		<input type="text" id="div_type" name="div_type" value="<?php echo set_value('div_type', $div_type)?>" />
		<?php echo form_error('div_type'); ?>
		<br />
		
		<label for="title">Titulo:</label>
		<input type="text" id="div_title" name="div_title" value="<?php echo set_value('div_title', $div_title)?>" />
		<?php echo form_error('div_title'); ?>
		<br />
		
		<label for="header">Conteudo:</label>
		<textarea id="div_content" name="div_content" rows="10" cols="50" class="tinymce">
			<?php echo set_value('div_content', $div_content)?>
		</textarea>
	
		<?php echo form_error('div_content'); ?>
		
		<br />
	
		<div class="buttons">
			<input type="button" value="Voltar" onclick="Javascript:list_back('pages/<?php echo $id_page ?>/divs')" />
			
			<input type="submit" value="Salvar Div" />
			
			<?php if(is_numeric($id)) { ?>
				<input type="button" value="Excluir Div" onclick="Javascript:div_del('<?php echo $id_page . "','" . $id ?>')" />
			<?php } ?>
		</div>
	
		<?php echo form_close() ?>

	</fieldset>
	
</div>
