<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TinyMCE Inclusion Class
 *
 * @package       CodeIgniter
 * @subpackage    Libraries
 * @category      WYSIWUG
 * @author        Flechaweb
 */

class Tinymce {
/*
 * Create Head Code 
 * $data ['head'] = $this->tinymce->createhead('mode','theme','toolbar loc','toolbar align','resizable')
 */
	public function header($in = 'textarea', $theme = 'advanced', $posX = 'left', $posY = 'top', $resizable = 'false') { 
		
        return <<<EOF
        
				<!-- tinymce -->
				<script type="text/javascript" src="/lib/js/tinymce/jquery.tinymce.js"></script>
			
				<script type="text/javascript">
				$().ready(function() {
					$('{$in}.tinymce').tinymce({
					
						// Location of TinyMCE script
						script_url : '/lib/js/tinymce/tiny_mce.js',
				
						// General options
						theme : "{$theme}",
						language : 'pt',
						plugins : "tabfocus, table",
						
						// COMPLETE PLUGINS
						//plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
				
						// Theme options
						theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,outdent,indent,undo,redo,link,unlink,image,table,code",
						theme_advanced_buttons2 : "",
						theme_advanced_buttons3 : "",
						
						/*
						DEFAULT - COMPLETE OPTIONS
						theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
						theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
						theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
						theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
						*/
			
						theme_advanced_toolbar_location : "{$posY}",
						theme_advanced_toolbar_align : "{$posX}",
						theme_advanced_statusbar_location : "none",
						theme_advanced_resizing : {$resizable},
						theme_advanced_path : false,
			
						tab_focus : ':prev,:next',
						
						// Example content CSS (should be your site CSS)
						//content_css : "/lib/css/admin.css",
						/*
						// Drop lists for link/image/media/template dialogs
						template_external_list_url : "lists/template_list.js",
						external_link_list_url : "lists/link_list.js",
						external_image_list_url : "lists/image_list.js",
						media_external_list_url : "lists/media_list.js",
				
						// Replace values for the template plugin
						template_replace_values : {
							username : "Some User",
							staffid : "991234"
						}
						*/
						
					});
				});
				</script>
EOF;

    }
    
}
?>