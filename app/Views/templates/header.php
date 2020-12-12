<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

		<script src="https://kit.fontawesome.com/cc8d392e40.js" crossorigin="anonymous"></script>


		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

		<title>Hello, world!</title>
		<style>
			body {
				background-color: #f3f3f3;
			}

			div.nav-link {
				cursor: pointer;
			}

			.note .card,
			.note .edit,
			.add .card{
				width: 18rem;
				height: 18rem;
			}

			.edit {
				background-color: rgba(0,0,0,.5);
			}

			.fa-plus:hover {
				opacity: .5;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark <?= session()->get('logged_in') ? '' : 'd-none' ?>">
			<a class="navbar-brand" href="#">Notes</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto"></ul>
				<div class="form-inline my-2 my-lg-0 text-white">Selamat datang, 
					<div class="dropdown show">
						<div class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
							<?= session()->nama; ?> <span class="sr-only">Toggle Dropdown</span>
						</div>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
					    	<a class="dropdown-item" href="<?= base_url()."/Login/logout" ?>">Logout</a>
						</div>
					</div>

				</div>
			</div>
		</nav>
