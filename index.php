<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--Latest compiled and minified Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="icon/css/all.min.css">
	<title>CRUD en php</title>

	<!-- custom css -->
	<style type="text/css">
		table tr td:last-child a {
			margin-right: 15px;
		}
	</style>
</head>

<body>

	<?php require_once 'crudQuery.php'; ?>

	<div class="container">
		<?php
		if (isset($_SESSION['message'])): ?>

			<div class="<?= $_SESSION['msg_type']; ?>">
				<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
				?>
			</div>
		<?php endif ?>
	</div>
	<!-- HTML form for creating a new patient -->
	<div class="container mt-2 mb-4 p-2 shadow ">

		<form action="crudQuery.php" method="post">
			<div class="form-row justify-content-center">
				<!-- Add patient code, code_pat, to the hidden field value -->
				<input type="hidden" name="code" value="<?php echo $ID_event; ?>" />
				<div class="col-auto">
					<input type="text" name="nom_event" class="form-control" value="<?php if (isset($nom_event))
						echo $nom_event; ?>" placeholder="Entrer un nom evenement" />
				</div>
				<div class="col-auto">
					<input type="date" name="date_event" class="form-control" value="<?php if (isset($date_event))
						echo $date_event; ?>" placeholder="Entrer une date" />
				</div>
				<div class="col-auto">
					<input type="text" name="adresse_event" class="form-control" value="<?php if (isset($adresse_event))
						echo $adresse_event; ?>" placeholder="Entrer une adresse" />
				</div>
				<div class="col-auto">
					<input type="text" name="nb_limite_evenement" class="form-control" value="<?php if (isset($nb_limite_evenement))
						echo $nb_limite_evenement; ?>" placeholder="nombre limite" />
				</div>
				<div class="col-auto">
					<?php
					if ($maj == true):
						?>
						<button type="submit" name="update" class="btn btn-info">Mettre à jour</button>
					<?php else: ?>
						<button type="submit" name="enregistrer" class="btn btn-primary">Enregistrer</button>
					<?php endif; ?>
				</div>
			</div>
		</form>

	</div>
	<!-- PHP code to read records from the patient table -->
	<?php
	// include database connection
	include("config/connexion.inc.php");
	// select query
	$result = mysqli_query($conn, "SELECT * FROM event") or die("erreur");
	?>

	<div class="container">
		<!-- ADD HTML table that will display data from the database -->
		<table class="table table-bordered table-striped">
			<!-- Creating table heading -->
			<thead>
				<tr>
					<th>Nom evenement</th>
					<th>Date evenement</th>
					<th>Lieu evenement</th>
					<th>Nombre limite d'evenement</th>
					<th colspan="2">Action</th>
				</tr>
				<thead>
					<!-- Creating table body -->
				<tbody>

					<?php
					//Retrieve contents from the patient table
					//Loop through the list of records from this table
					while ($ligne = mysqli_fetch_array($result, MYSQLI_BOTH)) { ?>
						<!-- Creating new table row per record -->
						<tr>
							<td>
								<?php echo $ligne['nom_event']; ?>
							</td>
							<td>
								<?php echo $ligne['date_event']; ?>
							</td>
							<td>
								<?php echo $ligne['lieu_event']; ?>
							</td>
							<td>
								<?php echo $ligne['nb_limite_event']; ?>
							</td>
							<td style="width: 10%">
								<!-- Creating action icons for each record displayed in the table -->
								<a href="index.php?modifier=<?php echo $ligne['ID_event']; ?>"
									title="Modification enregistrement" data-toggle="tooltip"><span
										class="fa fa-pencil-alt"></span></a>
								<a href="crudQuery.php?supprimer=<?php echo $ligne['ID_event']; ?>"
									title="Suppression enregistrement" data-toggle="tooltip"><span
										class="fa fa-trash"></span></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
		</table>

	</div>

	<!-- Optional JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
		crossorigin="anonymous"></script>

	<!--Script for removing the alert message after three seconds via the SetTimeout() method -->
	<!--Script for enabling tooltips in the document via the tooltip() method -->
	<script type="text/javascript">
		$(document).ready(function () {
			setTimeout(function () {
				$(".alert").remove();
			}, 3000);

			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>

</body>

</html>