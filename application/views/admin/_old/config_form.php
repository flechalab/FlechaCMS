<?php echo validation_errors() ?>

<h2><?php echo $top_title ?></h2>

<div id="container">

	<h3> > Manutenção de Configurações do Site:</h3>

	<?php echo form_open('admin/config/' . $config) ?>
	
	<fieldset>
	
		<label for="config">Configuração: </label>
		<input type="text" id="config" name="config" value="<?php echo set_value('config', $config)?>" />
		<?php echo form_error('config'); ?>
		<br />
				
		<label for="value">Value:</label>
		<input type="text" id="value" name="value" value="<?php echo set_value('value', $value)?>" />
		<?php echo form_error('value'); ?>
		<br />
		
	</fieldset>
	
	<div class="buttons">
		<input type="button" value="Voltar" onclick="Javascript:list_back('config')" />
			
		<input type="submit" value="Salvar Configuração" />
		
	</div>	
	
	<?php echo form_close() ?> 
	
</div>