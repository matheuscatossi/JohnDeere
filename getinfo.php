<?php
	require ("config.php");

	$query = "SELECT sum(consumo_medio)  as consumo_medio, count(*) as qtde, chassi,  sum(temperatura) as temperatura, sum(velocidade_media)  as velocidade_media FROM infoMaquina GROUP BY chassi";
	$result = mysql_query($query);

	if(mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
    	$arr_maquinas[$row['chassi']] = $row;
		}
	}

	if(isset($arr_maquinas)){
		foreach($arr_maquinas as $key => $value){
			$arr_maquinas[$key]['consumo_medio']    = $value['consumo_medio']    / $value['qtde']; 
			$arr_maquinas[$key]['temperatura']      = $value['temperatura']      / $value['qtde']; 
			$arr_maquinas[$key]['velocidade_media'] = $value['velocidade_media'] / $value['qtde'];
		}
	}
?>

<html>
<head>
	<title>getInfo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style>
		.text-large{
			font-size:33px;
		}
		.text-center{
			text-align:center;
		}
		.text-right{
			text-align:right;
		}

		.green {
			color:green;
		}

		.red {
			color:red;
		}
	</style>
	<script>
		$(function(){
			setInterval(function() { window.frm_info.submit(); }, 1000);
		})
	</script>
</head>
<body>
	<form name="frm_info" id="frm_info" method="POST">
		<div class="container-fluid">
		<div class="row" style="margin-top:20px; margin-bottom:20px;">
			<div class="col-sm-12 text-center">
				<img src="fazenda.jpg" style="width:500px; height:300px;"/>
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-12 text-center">
				<h1>Base - Fazenda</h1>
			</div>
		</div>
		<div class='row' style="margin-top:20px;">
			<div class="col-sm-12">
				<table class="table table-bordered table-horvered table-small table-striped">
					<thead>
						<tr>
							<th class="text-large text-center">Chassi</th>
							<th class="text-large text-center">Consumo médio</th>
							<th class="text-large text-center">Temperatura</th>
							<th class="text-large text-center">Velocidade Média</th>
						</tr>
					</thead>
					<tbody>
						<?php
							krsort($arr_maquinas);

							if(isset($arr_maquinas)){
								foreach($arr_maquinas as $key => $value){
									?><tr>
											<td class="text-large text-right"><?php print $value['chassi']; ?></td><?php
										?><td class="text-large text-right"><?php print $value['consumo_medio'] < 50 ? '<div class="row"><div class="col-sm-2"><i class="glyphicon glyphicon-arrow-up green"></i></div><div class="col-sm-10">' . number_format($value['consumo_medio'], 2, '.', '') . "</div></div>" : '<div class="row"><div class="col-sm-2"><i class="glyphicon glyphicon-arrow-down red"></i></div><div class="col-sm-10">' . number_format($value['consumo_medio'], 2, '.', '') . "</div></div>"; ?></td><?php
										?><td class="text-large text-right"><?php print number_format($value['temperatura'], 2, '.', ''); ?></td><?php
										?><td class="text-large text-right"><?php print number_format($value['velocidade_media'], 2, '.', ''); ?></td>
									</tr><?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</form>
</body>
</html>

