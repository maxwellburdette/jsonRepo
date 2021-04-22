function getJSON() {
	var form = document.getElementById("form")
	console.log(form)
	var thisRequest = new XMLHttpRequest()
	thisRequest.open("GET", "priceDataNew.json", true)
	thisRequest.setRequestHeader("Content-type", "application/json", true)
	thisRequest.onreadystatechange = function () {
		if (thisRequest.readyState == 4 && thisRequest.status == 200) {
			var storeJSON = JSON.parse(thisRequest.responseText)
			var store = storeJSON.gameStore
			let count = 0
			store.forEach(console => {
				createDataEntry(console, count)
				createProducts(console)
				count++
			})
		}
	}
	thisRequest.send(null)
	//Button input
	var button = document.createElement("input")
	button.className = "btn btn-secondary"
	button.type = "submit"
	button.value = "Submit"

	//Hidden input
	var hidden = document.createElement("input")
	hidden.type = "hidden"
	hidden.name = "hdnReturning"
	hidden.value = "returning"

	form.appendChild(hidden)
	form.appendChild(button)
}

function createDataEntry(console, count) {
	//Parse json data
	let consoleTypeData = console.consoleType
	let stockData = console.stock
	let skuData = console.sku
	//Get body for data entry
	let tbody = document.getElementById("dataEntry")

	//Create inputs

	//Stock inputs
	let stockInput = document.createElement("div")
	stockInput.className = "form-floating my-3"
	let stockField = document.createElement("input")
	stockField.type = "text"
	stockField.className = "form-control"
	stockField.id = "stock" + count
	stockField.placeholder = "Enter name of console"
	stockField.value = stockData
	stockField.name = "stock" + count
	let stockLabel = document.createElement("label")
	stockLabel.htmlFor = "stock" + count
	stockLabel.innerText = "Stock"
	stockInput.appendChild(stockField)
	stockInput.appendChild(stockLabel)

	//Sku inputs
	let skuInput = document.createElement("div")
	skuInput.className = "form-floating my-3"
	let skuField = document.createElement("input")
	skuField.type = "text"
	skuField.className = "form-control"
	skuField.id = "sku" + count
	skuField.placeholder = "Enter name of console"
	skuField.value = skuData
	skuField.name = "sku" + count
	let skuLabel = document.createElement("label")
	skuLabel.htmlFor = "sku" + count
	skuLabel.innerText = "Stock"
	skuInput.appendChild(skuField)
	skuInput.appendChild(skuLabel)

	//Stock input

	//Create row and get styling
	let row = document.createElement("tr")
	row.className = "table-light"

	//Create columns
	let consoleType = document.createElement("td")
	consoleType.className = "py-4"
	let stock = document.createElement("td")
	let sku = document.createElement("td")

	//Put data in columns
	//consoleType.appendChild(consoleInput)
	consoleType.innerText = consoleTypeData
	stock.appendChild(stockInput)
	sku.appendChild(skuInput)

	//Append columns into row
	row.appendChild(consoleType)
	row.appendChild(stock)
	row.appendChild(sku)

	//Append row into body
	tbody.appendChild(row)
}

function createProducts(console) {
	//Get data
	let consoleTypeData = console.consoleType
	let stockData = console.stock
	let skuData = console.sku
	let descriptionData = console.description
	let imageData = console.image

	//Get product container
	let container = document.getElementById("products")

	//Create card
	let card = document.createElement("div")
	card.className = "shadow card my-3"
	card.style.width = "18rem"
	card.style.maxHeight = "400px"
	card.style.overflowY = "auto"

	//Create image element
	let image = document.createElement("img")
	image.src = imageData
	image.className = "card-img-top"
	image.alt = ""

	//Create body
	let body = document.createElement("div")
	body.className = "card-body"

	//Create headers
	let consoleHeader = document.createElement("h5")
	consoleHeader.style = "text-align: center"
	consoleHeader.innerText = consoleTypeData

	let stockHeader = document.createElement("h5")
	stockHeader.innerText = "Stock: " + stockData

	let skuHeader = document.createElement("h5")
	skyHeader = "SKU: " + skuData

	let descriptionHeader = document.createElement("h5")
	descriptionHeader.innerText = "Description: "

	//Create paragraph element
	let p = document.createElement("p")
	p.innerText = descriptionData
	p.style.overflowY = "auto"

	card.appendChild(image)
	body.appendChild(consoleHeader)
	body.appendChild(stockHeader)
	body.appendChild(skuHeader)
	body.appendChild(descriptionHeader)
	body.appendChild(p)
	card.appendChild(body)

	container.appendChild(card)
}

getJSON()
