 
 <div id="profilecontainer">
		<?php 
 if(!isset($_GET["p"])){
	
	header("Location:" .BASE_PATH);
	exit();
 }
// echo $p->enc_dec("decrypt", $p->Clean(str_replace(" ", "+",$_GET["p"])));
 
 $row = $Pr->fetch(PDO::FETCH_BOTH);
  $myDir = dirname(dirname(dirname(dirname(__FILE__))));
  if(file_exists($myDir ."/public/img/signs/" .$row[0] ."png")){
		unlink($myDir ."/public/img/signs/" .$row[0] ."png");
  }
	/*$data = base64_decode($row["Signature"]);
	$s = file_put_contents($myDir ."/public/img/signs/" .$row[0] .".png", $data);*/
	$data = $row["Signature"];
	$decodeimg = base64_decode(str_replace(" ", "+", $data));
	
 ?> 
	<span id="currkey"><?php echo $_GET["p"] ?></span>
	<span id="part"><?php echo $row["ID"] ?></span>
	<div id="picprofile">
		<?php 
			if($exists == 1){
				echo "<img class='picture' src='" .BASE_PATH ."display?p=" .$_GET["p"] ."' width='120' height='120' />";
			}else{ 
				echo "<img class='picture' src='" .BASE_PATH ."public/img/nophoto.png' width='120' height='120'/>";
			}
		?>
		<?php 
			if($password == null){
				echo "<a href='javascript:void(0)' class='edit foredit' id='" .$row["ID"] ."'>Edit</a>";
			}
		?>
	</div>
		<fieldset>
			<ul>
				<li><span class="profiletitle">First Name: </span><?php echo ucwords($p->decodechar($row["FirstName"])) ?></li>
				<li><span class="profiletitle">Last Name: </span><?php echo ucwords($p->decodechar($row["LastName"])) ?></li>
				<li><span class="profiletitle">Contact No.: </span><?php echo ucwords($p->decodechar($row["CellphoneNo"])) ?></li>
				<!--<li><span class="profiletitle">Email Address: </span><?php //echo $p->decodechar($row["Email"]) ?></li>-->
				<li><span class="profiletitle">School: </span><?php echo ucwords($p->decodechar($row["School"])) ?></li>
				<li><span class="profiletitle">Gender: </span><?php echo ucwords($p->decodechar($row["Gender"])) ?></li>
				<li><span class="profiletitle">Region: </span><?php echo ucwords($p->decodechar($row["Region"])) ?></li>
				<li><span class="profiletitle">Individual: </span><?php echo ucwords($p->decodechar($row["Individual"])) ?></li>
				<li><span class="profiletitle">Institutional: </span><?php echo ucwords($p->decodechar($row["Institutional"])) ?></li>
				<li><span class="profiletitle">Date Registered: </span><?php echo $p->decodechar($row["DateRegistered"]) ?></li>
			</ul>
		</fieldset>
		
		<div id="profilecontainer">
				<div id="piccontainer">
				<!--<img src="<?php //echo BASE_PATH ."frame?p=" .$p->enc_dec("encrypt", $row[5]);?>" height="70" width="250"/>
				<img src="<?php //echo "data:image/png;base64," .base64_encode($decodeimg) ?>" height="70" width="250"/>-->
			</div>
				<div id="camcontainer">
						<div id="camtitle">Take a picture</div>
						<div>
							<!--<p style="padding: 5px; font-family: verdana; font-size: 9px;">Please sign your signature here</p>
							<input type="button" id="btnClearSign" value="Clear"/>-->
							<input type="button" value="Configure" id="btnConfig"/>
							<input type="button" value="Reset" id="btnReset"/>
							<input type="button" value="Capture Image" id="btnCap"/>
						 </div>
						<div id="webcam"></div>
						
					</div>
		</div>
 </div>
 <?php //echo $html->includeJs("webcam") ?>
 