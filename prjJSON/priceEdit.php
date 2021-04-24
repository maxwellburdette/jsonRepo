<!-- 
    File: editPrices.php (Allows you to edit and view JSON data)
    Server Side Development / Project: JSON
    Maxwell Burdette / burdettm@csp.edu
    04/22/2021
 -->
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
		<?PHP
			$jsonFileName = 'priceData.json';
			if(array_key_exists('hdnReturning', $_POST))
			{

				$thisArray = readJSON($jsonFileName);

				//Replace the data in array with the user input 
				for($i = 0; $i < count($thisArray['gameStore']); $i++)
				{
					$thisArray['gameStore'][$i]['stock'] = $_POST['stock'.$i];
					$thisArray['gameStore'][$i]['sku'] = $_POST['sku'.$i];
				}
				
				writeJSON($thisArray, $jsonFileName);
			}
			else
			{

			}
		?>
	</head>
	<body>
		
		<h1 class="m-3" style="text-align: center">Edit Products</h1>

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

		<h1 class="m-3" style="text-align: center">Products</h1>
		<div
			id="products"
			class="container-sm my-3 d-flex justify-content-around align-items-center flex-wrap"
		></div>

		<h1 class="m-3" style="text-align: center">What is AJAX?</h1>

		<div class="container-sm my-5">
			<div class="accordion accordion-flush" id="accordionFlushExample">
				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingOne">
						<button
							class="accordion-button collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#flush-collapseOne"
							aria-expanded="false"
							aria-controls="flush-collapseOne"
						>
							What is AJAX? What does it do? What are its advantages?
						</button>
					</h2>
					<div
						id="flush-collapseOne"
						class="accordion-collapse collapse"
						aria-labelledby="flush-headingOne"
						data-bs-parent="#accordionFlushExample"
					>
						<div class="accordion-body">
							AJAX is short for asynchronous javascript and XML. It is a set of we development techniques
							using many technologies on client-side to create asynchronous web applications. Information can
							be sent and received in the background without interfering with the display page. In modern practices it
							work with JSON data. Which is very easy to manipulate in javascript. 
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingTwo">
						<button
							class="accordion-button collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#flush-collapseTwo"
							aria-expanded="false"
							aria-controls="flush-collapseTwo"
						>
							How can PHP be used to create JSON data from database instead of the static .json file?
						</button>
					</h2>
					<div
						id="flush-collapseTwo"
						class="accordion-collapse collapse"
						aria-labelledby="flush-headingTwo"
						data-bs-parent="#accordionFlushExample"
					>
						<div class="accordion-body">
							When you are querying data from SQL you are getting an array, so it is just a matter of encoding that data
							into a JSON variable.

						</div>
					</div>
				</div>
			</div>
		</div>
  

		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
			crossorigin="anonymous"
		></script>
		<script src="ajax.js"></script>
		<?PHP
				function readWrite( ) {
					//JSON file
					$myfile = "priceData.json";

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

