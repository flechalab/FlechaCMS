<div id="container-admin">

    <div class="properties-button edit-block radius-all">
        <span class="ui-icon ui-icon-gear"></span><?php echo $form_label ?>
    </div>

	<?php echo form_open($form_url, array('class' => 'properties-form') ) ?>
	<fieldset>
		<?php
		foreach($form as $key => $item) {
			if($key=='id') { continue; }
            ?>
            <label for="<?php echo $key ?>"><?php echo $item['title'] ?>
            <?php echo (preg_match('/required/i', $item['validation'])) ? '*' : '' ?> :</label>
            <?php echo form_error($key); ?>
            <?php
            switch ($item['type']) {
                case 'input':
                    ?>
                    <input type="text" id="<?php echo $key ?>" name="<?php echo $key ?>"
                           value="<?php echo set_value($key, $item['value'])?>" />
                    <?php
                    break;
                case 'checkbox':
                    $checked = ($item['value']=='1') ? 'checked' : '';
                    ?>
                    <input type="checkbox" id="<?php echo $key ?>" name="<?php echo $key ?>"
                           <?php echo $checked ?> />
                    <?php
                    break;
                case 'textarea':
                    ?>
                    <textarea id="<?php echo $key ?>" name="<?php echo $key ?>" class="tinymce">
                        <?php echo set_value($key, $item['value'])?>
                    </textarea>
                    <?php
                    break;
                default:
                    break;
            }
            ?>
            <br />
			<?php
		}
		?>

    	<div class="buttons">
            <?php if( $form['id']['value'] > 0 && !isset($form['div_id']) ) { ?>
            <a href="<?php echo $uri .'/del/' . $form['id']['value'] ?>" id="deleteitem">Excluir</a>
            <?php } ?>
            <input type="submit" id="saveitem" value="Salvar" />
    	</div>

	</fieldset>	
	<?php echo form_close() ?>
</div>