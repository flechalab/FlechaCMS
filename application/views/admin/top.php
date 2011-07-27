<?php

if(!empty($title)) {
    echo "<h1 class=\"radius-bottom\">{$title}</h1>";
}

if(!empty($subtitle)) {
    echo "<h2>{$subtitle}</h2>";
}

if(isset($submenu) && $submenu==TRUE) { ?>
    <div id='links-top'>

        <?php
        //***********************
        // setting dynamic links 
        //***********************

        $back = '/' . $this->uri->segment(1);

        $segments = $this->uri->segment_array();

        // segments 2/3 => /page/{$id}, return /page
        if( isset($segments[2]) && isset($segments[3]) ) {
            $back .= '/' . $this->uri->segment(2);
        }

        // segments 4/5 => /page/{$id}/divs/{$id}, return /page/{$id}/divs
        if( isset($segments[4]) && isset($segments[5]) ) {
            $back .= '/' . $this->uri->segment(3);
        }

        $back_btn_disabled = array('login', 'logon');
        
        if( !in_array($this->uri->segment(2), $back_btn_disabled) ) {
            ?>
            <a href="<?php echo $back ?>" class="button">Voltar</a>
            <?php
        }
        
        if(!isset($form)) {
        //if(!isset($form['id']['value']) && $form['id']['value'] > 0) {
            ?>
            <a href="<?php echo '/' . $this->uri->uri_string() ?>/0" class="button">Novo</a>
            <?php
        }
        ?>
            <br class="clear" />
    </div>
<?php
}
