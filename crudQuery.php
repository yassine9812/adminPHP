<?php
//start session
session_start();

//Inclusion du fichier de connexion conn.php
include("config/connexion.inc.php");

//Set the $code variable to 0
$code = 0;

//Set the $maj variable to false
$maj = false;

//Code for saving patient's data
//Processing form data when form is submitted
//isset()is a PHP function used to verify if a variable is declared and is different than NULL
if (isset($_POST['enregistrer'])) {
	//Check input errors before inserting in database
	//empty()is a PHP function used to verify whether a variable is empty
	if (!empty($_POST['nom_event']) && !empty($_POST['date_event']) && !empty($_POST['adresse_event']) && !empty($_POST['nb_limite_evenement'])) {
		$nom_event = $_POST['nom_event'];
		$date_event = $_POST['date_event'];
		$adresse_event = $_POST['adresse_event'];
		$nb_limite_evenement = $_POST['nb_limite_evenement'];
		//insert query
		$sql = "INSERT INTO event (nom_event, date_event, lieu_event, nb_limite_event) VALUES('$nom_event', '$date_event', '$adresse_event', '$nb_limite_evenement')";
		$res = mysqli_query($conn, $sql);
		//Creating session messages and message types
		$_SESSION['message'] = "Un nouvel enregistrement a été ajouté avec succès!";
		//Alert success message when data is successfully stored
		$_SESSION['msg_type'] = "alert alert-success";
	} else {
		$_SESSION['message'] = "Les champs ne devraient pas être vides!";
		//Alert warning message when empty values are submitted
		$_SESSION['msg_type'] = "alert alert-warning";
	}
	// Redirect to index page and 
// tell the patient record was saved
	header("location: index.php");
}

//Code for deleting selected patient's data
//Get passed parameter value, in this case, ID_event
if (isset($_GET['supprimer'])) {
	$ID_event = $_GET['supprimer'];

	//delete query
	$sql = "DELETE FROM event WHERE ID_event='$ID_event'";
	$res = mysqli_query($conn, $sql);
	$_SESSION['message'] = "L'enregistrement choisi a été supprimé avec succès!";
	//Alert danger message when data is successfully deleted
	$_SESSION['msg_type'] = "alert alert-danger";

	// redirect to index page and 
	// tell the patient record was deleted
	header("location: index.php");
}

//Code for updating selected patient's data
//Get passed parameter value, in this case, ID_event
if (isset($_GET['modifier'])) {
	$ID_event = $_GET['modifier'];
	//Set the $maj variable to true
	$maj = true;
	$sql = "SELECT * FROM event WHERE ID_event='$ID_event'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1) {
		$ligne = mysqli_fetch_assoc($result);
		$nom_event = $ligne['nom_event'];
		$date_event = $ligne['date_event'];
		$adresse_event = $ligne['lieu_event'];
		$nb_limite_evenement = $ligne['nb_limite_event'];

	}

}

if (isset($_POST['update'])) {
	if (!empty($_POST['nom_event']) && !empty($_POST['date_event']) && !empty($_POST['adresse_event']) && !empty($_POST['nb_limite_evenement'])) {
		//Get hidden input value
		$ID_event = $_POST['ID_event'];
		$nom_event = $_POST['nom_event'];
		$date_event = $_POST['date_event'];
		$adresse_event = $_POST['adresse_event'];
		$nb_limite_evenement = $_POST['nb_limite_evenement'];

		//update query
		$sql = "UPDATE event SET nom_event='$nom_event', date_event='$date_event', lieu_event='$adresse_event', nb_limite_event='$nb_limite_evenement' WHERE ID_event='$ID_event'";
		$res = mysqli_query($conn, $sql);
		$_SESSION['message'] = "Le patient choisi a été modifié avec succès!";
		//Alert success message when data is successfully updated
		$_SESSION['msg_type'] = "alert alert-success";
	} else {
		$_SESSION['message'] = "Les champs ne devraient pas être vides!";
		//Alert warning message when empty values are submitted
		$_SESSION['msg_type'] = "alert alert-warning";
	}
	// redirect to index page and 
	// tell the patient record was updated
	header("location: index.php");
}

?>