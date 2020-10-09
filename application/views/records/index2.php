 <?php 
	$p = new Procedures();
	 
 ?>
 <div>
	<table>
		<tbody>
			<tr>
				<td>
					<label>Category:</label>
				</td>
				
				<td>
					<select id="cmbcategory"></select>
				</td>
				<td>
					<input type="text" id="txtsearch" placeholder="Search"/>
				</td>
				<td><input type="button" id="btnsearch" value="Search"/></td>
				<td>
					<?php echo "Total Records: " .$RecordCount; ?>
				</td>
			</tr>
		</tbody>
	</table>
 </div>
 <table id="members">
	<thead>
	    <tr>
			<th>Delete</th>
			<th>Edit</th>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Office/Company</th>
			<th>Position</th>
			<th>E-mail</th>
			<th>Track No.</th>
			<th>Classification</th>
			<th>Date Registered</th>
		</tr>
	</thead>
		<tbody>
			<?php while($row = $Records->fetch(PDO::FETCH_BOTH)){?>
				<tr>
					<td class="delete"><a href="#"><img src="<?php echo BASE_PATH; ?>img/delete.png" height="20" width="20" style="border: none;"/></a></td>
					<td class="edit"><a href="#"><img src="<?php echo BASE_PATH; ?>img/edit.png" height="20" width="20" style="border: none;"/></a></td>
					<td><?php echo $row[0] ?></td>
					<td class="pID"><a href="<?php echo BASE_PATH ."profile?p=" .$p->enc_dec("encrypt", $row[5]);?>"><?php echo $row[1]; ?></a></td>
					<td><?php echo $row[2] ?></td>
					<td><?php echo $row[3] ?></td>
					<td><?php echo $row[4] ?></td>
					<td><?php echo $row[5] ?></td>
					<td><?php echo $row[6] ?></td>
					<td><?php echo $row[7] ?></td>
					<td><?php echo $row[9] ?></td>
				</tr>
			<?php }?>
		</tbody>
 </table>
 <?php echo $html->includeJs("jquery.redirect.min"); ?>