	<!-- body start -->
	
	<div id="body">
		
		<?php 
		
		echo chr(10) . chr(13);
		
		// titulo da pagina (se houver)
		if(!empty($page[0]['title'])) {
			echo str_repeat(chr(9), 2);
			echo "<h2>{$page[0]['title']}</h2>";
			echo chr(10) . chr(13); 
		}

		// subtitulo da pagina (se houver)
		if(!empty($page[0]['title'])) {
			echo str_repeat(chr(9), 3);
			echo "<p><strong>{$page[0]['header']}</strong></p>"; 
			echo chr(10) . chr(13);
		}

		// print de cada div/table da pagina 
		foreach($divs as $div) {
 		
 			if($div['div_type']=='div') {
 				
 				// div main
 				echo str_repeat(chr(9), 2);
 				echo "<div id='{$div['div_id']}'>";
 				echo chr(10) . chr(13);

 				// h2 title
 				if(!empty($div['div_title'])) {
 					
 					echo str_repeat(chr(9), 3);
 					
 					if(is_null($div['div_url'])) {
 						echo "<h2>{$div['div_title']}</h2>";
 						echo chr(10) . chr(13);
					}
					else {
						echo "<h2><a href='{$div['div_url']}' target='_blank'>{$div['div_title']}</a></h2>";
						echo chr(10) . chr(13);	
					} 
				}
				
				// div content
				echo str_repeat(chr(9), 3);
				echo "<div class='content'>";
				echo chr(10) . chr(13);
				
				// conteudo da div
				echo str_repeat(chr(9), 4);
				echo str_replace(chr(10), chr(10) . str_repeat(chr(9), 4), $div['div_content']);  
				echo chr(10) . chr(13);
				
				// div content end
				echo str_repeat(chr(9), 3);
				echo "</div>";
				echo chr(10) . chr(13);

				// div main end
				echo str_repeat(chr(9), 2);
				echo "</div>";
				echo chr(10) . chr(13);
				
				if(!is_null($div['div_img'])) {
					echo str_repeat(chr(9), 3);
					echo "<div class='image'>{$div['div_img']}</div>";
					echo chr(10) . chr(13);
				}
				
 			}
  		}
 		
  		echo str_repeat(chr(9), 2);
  		echo "<br class='clear' />";
  		echo chr(10) . chr(13);
		?>
 			
	</div>	
	<!-- body end -->
