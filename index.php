<?php
	if (!file_exists($_SERVER['DOCUMENT_ROOT']."/config.php")) { 
		require_once($_SERVER['DOCUMENT_ROOT']."/createDB.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
	$db = new mysqli(DB_SERVER, DB_LOGIN, DB_PASSWORD, DB_NAME);
	// if (mysql_select_db(DB_NAME)) /*echo "GOOD;)"*/;

	$all_data_query = "SELECT * FROM clients
					   INNER JOIN advertisement on advertisement.c_id=clients.clients_id 
					   INNER JOIN tv_program on advertisement.p_id=tv_program.program_id
					   ORDER BY a_id";

	$result = $db->query($all_data_query);

	function rating($day){

	if ($day=='Monday'):
		return 1;
	elseif ($day=='Tuesday') :
		return 2;
	elseif ($day=='Wednesday') :
		return 3;
	elseif ($day=='Thursday') :
		return 4;
	elseif ($day=='Friday') :
		return 5;
	elseif ($day=='Saturday') :
		return 6;
	else:
		return 7;
	endif;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>tv_department_db</title>
</head>
<body>
	<style>
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		html, body {
			width: 100%;
			min-height: 100%;
		}
		body{
			font-family: Arial;
			/*background: #cccccc url(http://vefego.com/i/sky-hd-wallpaper-for-android-fe33pz.jpg) no-repeat;*/
			background: #cccccc url(http://img08.deviantart.net/4be1/i/2012/110/9/1/abstract_sky_scene__alternate_and_improved__by_toreshii_chann-d4wyutw.jpg) no-repeat;
			background-size: cover;
			font-size: 15px;
		}
		.wrapper{
			width: 100%;
			max-width: 900px;
			margin: 0 auto;
		}
		header{
			width: 100%;
			background: rgba(220, 220, 220, 0.8);
			padding: 20px 0;
			font-size: 3em;
			text-indent: 30px;
			color: #000000;
			/*color: #444444;*/
			font-style: italic;
			font-weight: bold;
			opacity: .3;
		}
		#content{
			width: 100%;
		}
		.price_list{
			width: 100%;
			background: rgba(220, 220, 220, 0.7);
			color: #000000;
			position: relative;
			float:left;
			margin: 10px auto;
			padding: 10px;
			font-weight: bold;
		}
		.price_list>ul{
			width: 100%;
			position: relative;
			float:left;
		}
		.main_list{
			width: 49%;
		}
		.price_list li{
			list-style: none;
			padding:5px 0;
			/*margin-left: 20px;*/
			position: relative;
			float:left;
		}
		.price_list li ul li{
			float:none;
		}
		h1{
			text-align: center;
			font-style: italic
		}
		table{
			background: rgba(220, 220, 220, 0.4);
			margin: 0px auto 10px;
			font-size: 1.2em;
			width: 100%;
			position: relative;
			float:left;
		}
		td{
			 background: rgba(220, 220, 220, 0.5);
			 color: #000000;
			 text-align: center;
			 padding: 5px;
		}
		.main{
			color: #000000;
			font-weight: bold;
		}
	</style>
	<header>
		<div class="wrapper">
			TV department
		</div>
	</header>
	<div id="content">
	<div class="wrapper">
		<div class="price_list">
			<h1>Price list</h1>
			<ul>
				<li class = "main_list"><h2>Price for the second show in the week</h2>
					<ul>
						<li>Monday - $ 1 per second advertising</li>
						<li>Tuesday - $ 2 per second advertising</li>
						<li>Wednesday - $ 3 per second advertising</li>
						<li>Thursday - $ 4 per second advertising</li>
						<li>Friday - $ 5 per second advertising</li>
						<li>Saturday - $ 6 per second advertising</li>
						<li>Sunday - $ 7 per second advertising</li>
					</ul>
				</li>
				<li class = "main_list"><h2>The price of advertising in the show:</h2>
					<ul>
						<li>Rating 1 - $ 2 per second advertising </li>
						<li>Rating 2 - $ 4 per second advertising </li>
						<li>Rating 3 - $ 6 per second advertising </li>
						<li>Rating 4 - $ 8 per second advertising </li>
						<li>Rating 5 - $ 10 per second advertising </li>
						<li>Rating 6 - $ 12 per second advertising </li>
						<li>Rating 7 - $ 14 per second advertising </li>
						<li>Rating 8 - $ 16 per second advertising </li>
						<li>Rating 9 - $ 18 per second advertising </li>
						<li>Rating 10 - $ 20 per second advertising </li>
					</ul>
				</li>
			</ul>
		</div>
			<table>
				  <tr class="main">
					<td>ID</td>
					<td>Name</td>		
					<td>City</td>
					<td>Duration</td>		
					<td>Price</td>
					<td>Product</td>
					<td>Day</td>
				  </tr>
				<?php 			
					while ($row = $result->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $row['a_id']; ?></td>
							<td><?php echo $row['c_name']." ".$row['c_surname']; ?></td>		
							<td><?php echo $row['rating']; ?></td>
							<td><?php echo $row['p_duration']." sec"; ?></td>
							<td><?php echo "$ ".(($row['rating']*round($row['p_duration']))*2*rating($row['day'])); ?></td>		
							<td><?php echo $row['promotional_product']; ?></td>
							<td><?php echo $row['day']; ?></td>
						 </tr>
				<?php	}
				?>
			</table>
<!-- 	</div>
</div>
 --></body>
</html>