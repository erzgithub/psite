
<?php 
$p = new Procedures();
 
 //echo $p->enc_dec("encrypt", "20140913152153");
 //echo $p->enc_dec("decrypt", "M2BdoEFD+6VSSzBRakfG9bzgciZSKG3rOJlltbCTG20=");

$FN = null;
$LN = null;
$Office = null;
$Position = null;
$EmailAddress = null;
$TrackNo = null;
$Classification = null;
$Contact = null;
$InstitutionMember = "";
$Individual = null;
$Gender = null;
$Address = null;
$imagekey = null;
$Member = null;
$Region = null;
$School = null;

$State = isset($_POST["State"]) ? $p->Clean($_POST["State"]) : null;
	if(isset($_POST["PK"])){
		$id = filter_var($_POST["PK"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$values = array(":ID" => $id);
		$condition = "Where ID = :ID";
		$registration = new Registration();
		$reg = $registration->LoadChoices("tbl_persons", "*", true, $condition, null, $values);
		$row = $reg->fetch(PDO::FETCH_BOTH);
		$FN = $p->decodechar($row["FirstName"]);
		$LN = $p->decodechar($row["LastName"]);
		$Address = $p->decodechar($row["Address"]);
		$Contact = $p->decodechar($row["CellphoneNo"]);
		$EmailAddress = $p->decodechar($row["Email"]);
		$Gender = $p->decodechar($row["Gender"]);
		$School = $p->decodechar($row["School"]);
		$Region = $p->decodechar($row["Region"]);
		$Individual = $p->decodechar($row["Individual"]);
		$InstitutionMember = $p->decodechar($row["Institutional"]);
		$p->sec_session_start();
	//	$_SESSION["IK"] = $row[9];
		//$Classification = $row[7];
	}
?>  
<div id="state"><?php echo $State; ?></div>
 <div class="regform">
	<form action="" method="POST" class="regform">
		<fieldset>
			<table style="/**/border: 1px solid #ccc; width: 500px; float:left; z-index: 100;">
				<tbody>
					<tr>
						<td>
							<label >First Name:</label>
						</td>
						<td>
							<input type="text" name="FN" id="regFN" placeholder="First Name:" class="tbdesign" value="<?php echo $FN; ?>"/>
						</td>
						 
							<td >
								<div style="position:relative;  color:red;">
									<p id="warnfn" class="warning">Provide First Name</p>
								</div>
							</td>
						 
					</tr>
					
					<tr>
						<td>
							<label >Last Name:&nbsp;</label>
						</td>
						
						<td>
							<input type="text" name="LN" id="regLN" placeholder="Last Name:" class="tbdesign" value="<?php echo $LN; ?>"/>
						</td>
						
						<td>
							<div style="position:relative;  color:red;">
								<p id="warnln" class="warning">Provide Last Name</p>
							</div>
						</td>
					</tr>
					 
					
					<tr>
						<td>
							<label>Designation:</label>
						</td>
						<td>
							<input type="text" name="pos" id="regdesignation" placeholder="Position:" class="tbdesign" value="<?php echo $Position; ?>"/>
						</td>
						<td>
							<div style="position:relative;  color:red;">
								<p id="warnposition" class="warning">Provide Designation</p>
							</div>
						</td>
					</tr> 
					
					<!----><tr>
						<td><label>E-mail Address:</label></td>
						<td>
							<input type="text" name="email" id="regemail" placeholder="E-mail:" class="tbdesign" value="<?php echo $EmailAddress; ?>"/>
						</td>
						<td>
							<div style="position:relative;  color:red;">
								<p id="warnemail" class="warning">Provide E-mail Address</p>
							</div>
						</td>
					</tr>
					
					<tr>
						<td><label>Password:</label></td>
						
						<td>
							<input type="password" name="idpass" id="regpassword" placeholder="Password" />
						</td>
						
						<td>
							<div style='position:relative; color:red;'>
								<p id="warnpassword" class="warning">Provide password</p>
							</div>
						</td>
					</tr>
					
					
				<!--	<tr>
						<td>Course</td>
						<td>
							<input type="text" id="regcourse" Placeholder="Course" class="tbdesign" value="<?php echo $Course ?>"/>
						</td>
						<td>
							<div style="position:relative;  color:red;">
								<p id="warncourse" class="warning">Provide Course</p>
							</div>
						</td>
					</tr> -->
					
					<tr>
						<td><label>Gender:</label></td>
						<td>
							<div>
								<select name="cmbgender" id="cmbgender">
									<?php if($Gender){echo "<option>" .$Gender ."</option>";} ?>
								</select>
							</div>
						</td>
					</tr>
					
					<tr>
						<td>Address:</td>
						<td>
							<input type="text" id="regaddress" Placeholder="Address" class="tbdesign" value="<?php echo $Address ?>"/>
						</td>
						<td>
							<div style="position:relative;  color:red;">
								<p id="warncourse" class="warning">Provide Address</p>
							</div>
						</td>
					</tr>
					
					<tr>
						<td>Contact No.:</td>
						<td>
							<input type="text" id="regcontact" Placeholder="Contact" class="tbdesign" value="<?php echo $Contact ?>"/>
						</td>
						<td>
							<div style="position:relative;  color:red;">
								<p id="warncourse" class="warning">Provide Contact</p>
							</div>
						</td>
					</tr>
					
					<tr>
						<td>Region:</td>
						<td>
							<div>
								<select name="cmbregion" id="cmbregion">
									<?php if($Region){echo "<option>" .$Region ."</option>";} ?>
								</select>
							</div>
						</td>
					</tr>
					
					<tr>
						<td>Individual:</td>
						<td>
							<div>
								<select name="cmbindi" id="cmbindi">
									<?php if($Individual){echo "<option>" .$Individual ."</option>";} ?>
								</select>
							</div>
						</td>
					</tr>
					
					 <tr>
						<td>School:</td>
						<td>
							<input type="text" id="regschool" Placeholder="School" class="tbdesign" value="<?php echo $School ?>"/>
						</td>
						<td>
							<div style="position:relative;  color:red;">
								<p id="warncourse" class="warning">Provide School</p>
							</div>
						</td>
					</tr>
					
					<tr>
						<td>Institutional:</td>
						<td>
							<div>
								<select name="cmbins" id="cmbins">
									<?php if($InstitutionMember) echo "<option>" .$InstitutionMember ."</option>" ?>
								</select>
							</div>
						</td>
						<td>
							<div style="position:relative;  color:red;">
								<p id="warncourse" class="warning">Provide School</p>
							</div>
						</td>
					</tr>
					
					<!--<tr>
						<td><label>Classification:</label></td>
						<td>
							<div>
								<select name="cmbclass" id="cmbclass">
									<?php echo "<option>" .$Classification ."</option>"; ?>
								</select>
							</div>
						</td>
					</tr>-->
					<tr>
						<td>
							<input type="button" value="Register" id="btnreg"/>
						</td>
						<td>
					<!---->	  <div id="sc">
							<input type="checkbox" id="us"/>
							<label for="us">Update Password</label>
							
						  </div>
						</td>
						
					</tr>
				</tbody>
			</table>
				 
					<div  style="position: relative;left: 10px; width: 430px; float:left;">
						  <canvas id="imageView" width="400" height="150" style="background: #fff; padding: 20px;">
								
						  </canvas>
							<!--<div id="webcam">
							
							</div>-->
						 <div>
							<p style="padding: 5px; font-family: verdana; font-size: 9px;">Please sign here</p>
							<input type="button" id="btnClearSign" value="Clear"/>
							<!--<input type="button" value="Configure" id="btnConfig"/>
							<input type="button" value="Reset" id="btnReset"/>
							<input type="button" value="Capture Image" id="btnCap"/>-->
						 </div>
					</div>
					
				 
		   <!----><div id="bsec"></div>
		</fieldset>
	</form>
	<?php echo $html->includeJs("sign") ?>
	<?php //echo $html->includeJs("webcam") ?>
 </div>
 <div style="width: 750px; margin-left:auto; margin-right:auto;">
			<!--<div style="width: 500px; margin-left: auto; margin-right: auto; margin-top: 15px;">
				<img src="<?php echo BASE_PATH .'public/img/bd.png' ?>" height="200" width="500"/>
			</div>
			<div id="img1" style="float:left;">
				<img src="<?php echo BASE_PATH ."public/img/cio.png" ?>" height="250" width="250"/>
			</div>
			<div id="img2" style="float:left;">
				<img src="<?php echo BASE_PATH ."public/img/ciof.png" ?>" height="250" width="250"/>
			</div>
			<div id="img3">
				<img src="<?php echo BASE_PATH ."public/img/dost.png" ?>" height="250" width="250"/>
			</div>-->
		</div>
		