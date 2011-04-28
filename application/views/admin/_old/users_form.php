<?php echo validation_errors() ?>

<h2><?php echo $top_title ?></h2>

<div id="container">

	<h3> > Manutenção de Usuários do Site:</h3>

	<?php echo form_open('admin/users/' . $id) ?> 
	
	<fieldset>
	
		<label for="page">Usuário: </label>
		<input type="text" id="user" name="user" value="<?php echo set_value('user', $user)?>" />
		<?php echo form_error('user'); ?> 
		<br />
		
		<label for="title">Senha:</label>
		<input type="password" id="pass" name="pass" value="" />
		<?php echo form_error('pass'); ?> 
		<br />
		
		<label for="header">Nome:</label>
		<input type="text" id="name" name="name" value="<?php echo set_value('name', $name)?>" />
		<?php echo form_error('name'); ?> 
		<br />
		
		<label for="tooltip">Email:</label>
		<input type="text" id="mail" name="mail" value="<?php echo set_value('mail', $mail)?>" />
		<?php echo form_error('mail'); ?> 
		<br />

		<label for="tooltip">Telefone:</label>
		<input type="text" id="phone" name="phone" value="<?php echo set_value('phone', $phone)?>" />
		<?php echo form_error('phone'); ?> 
		<br />

		<label for="tooltip">Ativo:</label>
		<input type="text" id="active" name="active" value="<?php echo set_value('active', $active)?>" />
		<?php echo form_error('active'); ?> 
		<br />
		
	</fieldset>
	
	<div class="buttons">
		<input type="button" value="Voltar" onclick="Javascript:list_back('users')" />
			
		<input type="submit" value="Salvar Usuário" />
		
		<?php if(is_numeric($id)) { ?> 
			<input type="button" value="Excluir Usuário" onclick="Javascript:user_del(<?php echo $id ?>)" />
		<?php } ?>  
	</div>	
	
	<?php echo form_close() ?> 
	
</div>