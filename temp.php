<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title></title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="" />
	</head>
	<body>
		<?PHP
			$jsonFileName = 'priceDataNew.json';
			if(array_key_exists('hdnReturning', $_POST))
			{

				$thisArray = readJSON($jsonFileName);

				//Replace the data in array with the user input 
				$count = 0;
				foreach($thisArray as $key=>$value)
				{
					$value->stock = $_POST['stock'.$count];
					$value->sku = $_POST['sku'.$count];
					echo $count;
					$count++;

				}

				// for($i = 0; $i < count($thisArray); $i++)
				// {
				// 	$thisArray['gameStore'][$i]['stock'] = $_POST['stock'.$i];
				// 	$thisArray['gameStore'][$i]['sku'] = $_POST['sku'.$i];
				// }
				echo '$thisArray: <pre>';
				print_r($thisArray);
				echo '</pre>';
			}
			else
			{

			}
		?>
		<h1 class="m-2" style="text-align: center">Edit Prices</h1>

		<div class="container-sm my-5">
			<form 
				id="form"
				method="POST" 
				action="<?PHP echo $_SERVER['PHP_SELF'];?>" 
				>
				<table class="shadow table table-hover" style="text-align: center">
					<thead>
						<tr class="table-dark">
							<th>Console</td>
							<th>Stock</td>
							<th>Sku</td>
						</tr>
					</thead>
					<tbody id="dataEntry">
						
					</tbody>
				</table>
			</form>
		</div>

		<div id="result"></div>
		<!-- Modify the JSON file using PHP-->
		<?PHP 
			session_start();
			$myJSONFile = 'priceDataNew.json';
			//Set up temp array 
			$consoleArray = array();
			$consoleArray = readJSON($myJSONFile);

			//Hard code in a change to the first record with a time stamp
			//Later, the data from the form textboxes will be used
			date_default_timezone_set('America/Chicago');
			$consoleArray['gameStore'][0]['consoleType'] = 'Xbox Series X ' . date('h:i:sa');

			writeJSON($consoleArray, $myJSONFile);
		?>
		

		<h1 class="m-2" style="text-align: center">Products</h1>
		<div
			id="products"
			class="container-sm d-flex justify-content-around align-items-center flex-wrap"
		></div>

		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
			crossorigin="anonymous"
		></script>
		<script src="ajax.js"></script>
		<?PHP
				function readWrite( ) {
					//JSON file
					$myfile = "priceDataNew.json";

					//Setup temp array
					$consoleArray = array( );

					//Get contents from the JSON file
					$jsonData = file_get_contents($myfile);

					//Convert into array
					$consoleArray = json_decode($jsonData, true);
					
					//Hard-code in a change to the first record with a timestamp
					date_default_timezone_set("America/Chicago");
					$consoleArray['gameStore'][0]['consoleType'] = "Xbox Series X " . date("h:i:sa");

					//Convert update array back to JSON 
					$jsonData = json_encode($consoleArray, JSON_PRETTY_PRINT);

					//Write to file
					file_put_contents($myfile, $jsonData);

				}

				//Reads JSON file 
				function readJSON($myFile) 
				{
					//Set up an array to hold the JSON dataEntry
					$consoleArray = array( );

					try {
						//Get data from the JSON file
						$jsonData = file_get_contents($myFile);
						//convert it into an array
						$consoleArray = json_decode($jsonData, true);
						return $consoleArray;
					}
					catch (Exception $e) {
						echo 'Caught exception: ', $e->getMessage(), '\n';
					}
				}

				//Writes JSON file
				function writeJSON($myArray, $myFile)
				{
					//Convert array to JSON formatted variable
					$jsonData = json_encode($myArray, JSON_PRETTY_PRINT);
					
					try {
						//write to the JSON file
						if(file_put_contents($myFile, $jsonData)){
							echo 'Console file updated successfully<br />';
						}
						else
						{
							echo 'There was an error writing to the ' . $myFile . ' file. <br />';
						}
					}
					catch (Exception $e) {
						echo 'Caught exception: ', $e->getMessage(), '\n';
					}
				}

			?>
	</body>
</html>

