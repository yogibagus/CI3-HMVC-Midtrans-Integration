<!DOCTYPE html>
<html lang="en">

<head>
	<title>Demo Midtrans Implementation</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<!-- Brand -->
		<a class="navbar-brand" href="<?= base_url('') ?>">Midtrans CI HMVC</a>

		<!-- Links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('welcome/order_list') ?>">Order List</a>
			</li>
		</ul>
	</nav>

	<div class="jumbotron text-center">
		<h1>subscription Package</h1>
		<p>Choose subscription package type below!</p>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="card">
					<img class="card-img-top" src="<?= base_url('assets/img/iron-ore.png') ?>" alt="Card image" style="width:100%">
					<div class="card-body">
						<form action="<?= base_url() ?>welcome/details_package" method="get">
							<input type="hidden" value="001" name="package_id">
							<input type="hidden" value="50000" name="package_price">
							<input type="hidden" value="Iron Package" name="package_name">
							<input type="hidden" value="iron-ore" name="icon">
							<h4 class="card-title">Iron Package</h4>
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores ut deleniti numquam molestias, nobis culpa maxime nostrum officiis voluptatum.</p>
							<button type="submit" class="btn btn-block btn-primary stretched-link">Rp 50.000</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<img class="card-img-top" src="<?= base_url('assets/img/copper-ore.png') ?>" alt="Card image" style="width:100%">
					<div class="card-body">
						<form action="<?= base_url() ?>welcome/details_package" method="get">
							<input type="hidden" value="002" name="package_id">
							<input type="hidden" value="150000" name="package_price">
							<input type="hidden" value="Copper Package" name="package_name">
							<input type="hidden" value="copper-ore" name="icon">
							<h4 class="card-title">Copper Package</h4>
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores ut deleniti numquam molestias, nobis culpa maxime nostrum officiis voluptatum.</p>
							<button type="submit" class="btn btn-block btn-primary stretched-link">Rp 150.000</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<img class="card-img-top" src="<?= base_url('assets/img/gold-ore.png') ?>" alt="Card image" style="width:100%">
					<div class="card-body">
						<form action="<?= base_url() ?>welcome/details_package" method="get">
							<input type="hidden" value="003" name="package_id">
							<input type="hidden" value="300000" name="package_price">
							<input type="hidden" value="Gold Package" name="package_name">
							<input type="hidden" value="gold-ore" name="icon">
							<h4 class="card-title">Gold Package</h4>
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores ut deleniti numquam molestias, nobis culpa maxime nostrum officiis voluptatum.</p>
							<button type="submit" class="btn btn-block btn-primary stretched-link">Rp 300.000</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<br>
<hr>
<footer class="text-muted">
	<div class="container">
		<p class="float-right">
			<a href="#">Back to top</a>
		</p>
		<p>Demo Midtrans Implementation &copy; , please download and customize it for yourself!</p>
	</div>
</footer>

</html>