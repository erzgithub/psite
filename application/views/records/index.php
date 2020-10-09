<?php 
	$session->start();
	
	$session->put("valid.email", null);
	$session->put("valid.id", null);
?>
<div style="padding: 0 0 0 100px;">
	<table>
		<tbody>
			<tr>
				
				<td>
					<input type="text" id="txtsearch" placeholder="First name or Last name"/>
				</td>
				
				<td>
					<?php //echo "Total Records: " .$RecordCount; ?>
					<div id="recordcount">
					
					</div>
				</td>
			</tr>
		</tbody>
	</table>
 </div>
 <div id="loading"><img id="li" src="<?php echo BASE_PATH .'/img/ajax-loader.gif'?>"/></div>
<div id="reccontainer"></div>
 <?php echo $html->includeJs("jquery.redirect.min"); ?>
 <?php echo $html->includeJs("vscript") ?>