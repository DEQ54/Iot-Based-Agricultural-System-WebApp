<?php include('server.php') ?>
<?php
   header('Access-Control-Allow-Origin: *');
?>
<?php 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php#join_us');
  }
  $query = "SELECT * FROM sensors";
  $result = $db->query($query);

   while($row = $result->fetch_array())
  {
    $configurations[] = $row;
  }
  
?>


<!DOCTYPE html>
<html>
<head>
  <title>Sensor Data</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/normalize.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<style>
  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;

  }
  .cards {
	display: flex;
    width: 15vw;
    height: 23vh;
    padding: 10px;
    border: solid 2px white;
    border-radius: 20px;
    margin: 20px;
    text-align: center;
	border-bottom: 5px;
	justify-content: center;

  }
  /* #header{
	display: flex;
	background: red;
  } */
  .cards:hover {
    background-color: #1ab188;
    border: solid 2px white;
  }
  /* #wrapper {
    margin: 0;
    background: white
  } */

  .top-row-three{
	display: flex;
  }
</style>

<body class="is-preload">
	<div id="wrapper">
  <p style="position: absolute; right: 0; top: 0"> <button type="button"><a href="logout.php" style="color: white;">logout</a></button> </p>
  <br><h2 align = "center">Sensor Configuration Values</h2></br>
  
	<header id="header">
		<?php
			for ($x = 0; $x < sizeof($configurations); $x++) {
		?>
			<a class="cards" href="#configuration">
				<div id="<?php echo $x ?>">

				<?php
					echo $configurations[$x][0];
				?>

				</div>

			</a>

		<?php } ?>
	</header>

	<!-- Main -->
	<div id="main">

		<!-- Join Us -->
			<article id="configuration">
				<div class="form">
				<div class="tab-content">
					<div id="configuration">
					<h3 align = "center">Post Configuration Values</h3>
					<form id="form" method="post">
						<div class="top-row">
							<div class="field-wrap">
								<label class="active">
									Temperature
								</label>
								<input type="text" required autocomplete="off" id="temperature" name ="temperature" disabled/>
							</div>
							<div class="field-wrap">
								<label class="active">
									Soil Moisture
								</label>
								<input type="text" required autocomplete="off" id="moisture" name="moisture" disabled/>
							</div>
						</div>
						<div class="top-row-three">
							<div class="field-wrap">
								<label class="active">
									Nitrogen
								</label>
								<input type="text" required autocomplete="off" id="nitrogen" name ="n" disabled/>
							</div>
							<div class="field-wrap">
								<label class="active">
									Phosphorus
								</label>
								<input type="text" required autocomplete="off" id="phosphorus" name="p" disabled/>
							</div>
							<div class="field-wrap">
								<label class="active">
									Potassium
								</label>
								<input type="text" required autocomplete="off" id="potassium" name="k" disabled/>
							</div>
						</div>
						<div class="field-wrap">
							<label class="active">
							</label>
							<textarea type="text" required autocomplete="off" id="description" name="description"  disabled></textarea>
						</div>
						<button type="submit" class="button button-block" id=submit name="submit">Set Configuration</button>
						<div id="success_message" class="ajax_response" style="float:left"></div>
					</form>
					</div>

					
				<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
				<script  src="assets/js/post_config.js"></script>
				
			</article>
		</div>

	</div>

<!-- BG -->
	<div id="bg"></div>
<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script type="text/javascript">
		var configurations = <?php echo json_encode($configurations); ?>;
		function setVariables() {
			console.log('run')
			document.getElementById("temperature").value = configurations[this.id][2];
			document.getElementById("moisture").value = configurations[this.id][3];
			document.getElementById("nitrogen").value = configurations[this.id][4];
			document.getElementById("phosphorus").value = configurations[this.id][5];
			document.getElementById("potassium").value = configurations[this.id][6];
			document.getElementById("description").value = configurations[this.id][1];
		}

		for (let i = 0; i < configurations.length; i++) {
			document.getElementById(i).onclick = setVariables
		}
/*		$(document).ready(function(){
    $("#submit").click(function(e){
      e.preventDefault();
var xmlhttp = new XMLHttpRequest();   // new HttpRequest instance 
var url = "http://192.168.4.1/api/postConfig";
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
xmlhttp.send(JSON.stringify({ "soilTemperature":$("#temperature").val(),"soilMoisture": $("#moisture").val(),"n":$("#nitrogen").val(),"p":$("#phosphorus").val(),"k":$("#potassium").val() }));
      $.ajax({

		url:'http://192.168.4.1/api/postConfig',
		method:'post',
		dataType: 'text',
		cache: false,
		async: true,
    crossDomain: true,
    headers: {
    "accept": "application/json",
    "Access-Control-Allow-Origin":"*"},
		data:{"soilTemperature":$("#temperature").val(),"soilMoisture": $("#moisture").val(),"n":$("#nitrogen").val(),"p":$("#phosphorus").val(),"k":$("#potassium").val()},
	});

		    });
             });*/
	</script>
</body>
</html>
