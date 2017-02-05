<?php
require ("config.php");

if(isset($_REQUEST)){
	$chassi           = (int) "12345" . (rand(1, 7));
	$data             = date("Y-m-d");
	$hora             = date("H:i:s");

	$maximo = 0;
	if(isset($acao)){
		if($acao == 1) {
			$acao = 2;
			$maximo = 100;
		} else {
			$acao = 1;
			$maximo = 5;
		}
	} else {
		$maximo = 80;
	}


	$consumo_medio    = rand(0, $maximo);
	$temperatura      = rand(18, 32);;
	$velocidade_media = rand(4, 8);;

	$query = "INSERT INTO infoMaquina (chassi, data, hora, consumo_medio, temperatura, velocidade_media) VALUES (\"$chassi\",\"$data\",\"$hora\",\"$consumo_medio\",\"$temperatura\",\"$velocidade_media\")";

	mysql_query($query);	
}
?>

<html>
<head>
	<title>setInfo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<form name="frm_submit" id="frm_submit" method="POST">
		<input type="hidden" value="<?php print $acao?>" name="acao" id="acao"/>
		<div class='container-fluid'>
			<input type='hidden' value="S" name="set" id="set"/>
			<div class="row" style="margin-top:200px">
				<div class="col-sm-12 text-center">
					<img src="john-deere.png" style="width:700px; height:500px;"/>
				</div>
			</div>
			<div class="row" style="margin-top:100px">
				<div class='col-sm-12'>
					<input type='submit' name="btn_set" id="btn_set" value="JOHN DEERE" class="btn btn-success form-control" style="height:400px; font-size: 140px;color:#f9f218"/>
				</div>
			</div>
		</div>
	</form>
</body>
</html>