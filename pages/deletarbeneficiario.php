<?php
  // Connect to the database
  $conn = mysqli_connect("localhost", "username", "password", "database");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get the id of the account to be deleted
  $id = $_POST['id'];

  // Define the criteria for the deletion
  $criterio = [
    ['id', '=', $id]
  ];

  // Delete the account
  deleta('beneficiario', $criterio);

  // Close the database connection
  mysqli_close($conn);

  // Redirect the user to a confirmation page
  header('Location: index.html');
  exit;
?>