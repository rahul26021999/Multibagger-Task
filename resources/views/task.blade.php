<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<style>
			.btn-cyan{
				background-color: cyan;
				color: white;
			}
			.radio{
				display: inline-block;
				margin-right: 20px;
			}
			.modal-header .radio label{
				font-size: 18px;
				color: white;
			}
			
			.radio-white{
				
			}

			.modal-header{
				background-color: blue;
			}
			/*.close{
				color: white;
			}*/
		</style>


	</head>
	<body>

		<div class="container">
			<div class="row">
				<h3>Orders</h3>
				<div class="col-sm-3"><a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Place New Order</a></div>
				<div class="col-sm-3">
					<select onchange="search()" id="category-search" class="form-control">
						<option value="ALL">All</option>
						<option value="EQUITY">Equity</option>
						<option value="COMMODITY">Commodity</option>
					</select>
				</div>
				<div class="col-sm-3">
					<select onchange="search()" id="order-search" class="form-control">
						<option value="ALL">All</option>
						<option value="BUY">Buy</option>
						<option value="SELL">Sell</option>
					</select>
				</div>
				<div class="col-sm-3"><input type="text" name="search" id="search" class="form-control" placeholder="Search" onkeyup="search()"></div>
				
				<div class="col-sm-12" style="margin-top: 20px;">
					<div class="table-responsive">
						<table class="table table-hover" id="orders">
							<thead>
								<tr>
									<th>Tip</th>
									<th>Category</th>
									<th>Company</th>
									<th>Order Type</th>
									<th>Price</th>
									<th>Target</th>
									<th>StopLoss</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
								<tr>
									<td>{{$order->id}}</td>
									<td>{{$order->category}}</td>
									<td>{{$order->company}}</td>
									<td>{{$order->type}}</td>
									<td>{{$order->price}}</td>
									<td>{{$order->target}}</td>
									<td>{{$order->stoploss}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-id">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="{{route('place-order')}}" method="POST" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						
						{{-- Radio Buttons --}}

						<div class="radio">
							<label>
								<input type="radio" class="radio" name="category" id="input" value="EQUITY" checked="checked" >
								Equity
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" class="radio-white" name="category" id="input" value="COMMODITY">
								Commodity
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" class="radio-white" name="category" id="input" value="CURRENCY">
								Currency
							</label>
						</div>

					</div>
					<div class="modal-body">
							@csrf
						   <div role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#nse" aria-controls="home" role="tab" data-toggle="tab">NSE</a>
								</li>
								<li role="presentation">
									<a href="#bse" aria-controls="tab" role="tab" data-toggle="tab">BSE</a>
								</li>
								<li role="presentation">
									<a href="#FO" aria-controls="tab" role="tab" data-toggle="tab">F&O</a>
								</li>
							</ul>
						
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="nse">
									<div class="radio">
										<label>
											<input type="radio" name="delivery-type" id="input" value="intraday" checked="checked">
											Intraday
										</label>
									</div>
									<div class="radio ml-4">
										<label>
											<input type="radio" name="delivery-type" id="input" value="delivery">
											Delivery
										</label>
									</div>

									<input type="text" name="company-name" id="inputCompanyName" class="form-control" value="" required="required" placeholder="Enter Company Name">

									<div class="radio">
										<label>
											<input type="radio" name="order-type" id="input" value="limit" checked="checked">
											Limit
										</label>
									</div>
									<div class="radio ml-4">
										<label>
											<input type="radio" name="order-type" id="input" value="market">
											Market
										</label>
									</div>

									<div class="row">
										<div class="col-sm-4">
											
											<input type="number" name="price" id="price" class="form-control" value="" required="required" placeholder="Price">
										</div>
										<div class="col-sm-4">
											<input type="number" name="stoploss" id="stoploss" class="form-control" value="" required="required" placeholder="Stop Loss">
										</div>
										<div class="col-sm-4">
											<input type="number" name="target" id="target" class="form-control" value="" required="required" placeholder="Target">
										</div>
									</div>

								</div>

								<div role="tabpanel" class="tab-pane" id="bse"></div>
								<div role="tabpanel" class="tab-pane" id="FO"></div>
							</div>
						   </div>
					</div>
					<div class="modal-footer">
						<button type="submit" value="BUY" name="type" class="btn btn-cyan" >Buy</button>
						<button type="submit" value="SELL" name="type" class="btn btn-danger">Sell</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script>
			function search() {
				
				var search = document.getElementById("search").value.toUpperCase();
				var tableRows=document.getElementById("orders").getElementsByTagName("tr");
				var searchCategory =document.getElementById("category-search").value;
				var searchOrderType =document.getElementById("order-search").value;
			

				for(i=0;i<tableRows.length;i++)
				{
					var td=tableRows[i].getElementsByTagName("td")[2]; // Company Coloumn is selected
					if(td){
						var companyName = td.innerText.toUpperCase(); // In case comapany name is lower 
						var cateorgy = tableRows[i].getElementsByTagName("td")[1].innerText.toUpperCase();
						var type = tableRows[i].getElementsByTagName("td")[3].innerText.toUpperCase();

						var display=true;
						if(searchCategory != "ALL" && searchCategory != cateorgy){
							display=false;
						}
						if(searchOrderType!="ALL" && searchOrderType!=type){
							display=false
						}
						if(companyName.indexOf(search) > -1 && display) // Filter found in Company name
						{
							tableRows[i].style.display=""
						}else{
							tableRows[i].style.display="none"
						}
					}
				}
			}
		</script>
	</body>
</html>