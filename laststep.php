<?php
session_start();

$_SESSION["table_number"] = $_POST["table_number"];
$_SESSION["option_bs"] = $_POST["option_bs"];
$_SESSION["option_fa"] = $_POST["option_fa"];
$_SESSION["option_img"] = $_POST["option_img"];
$_SESSION["option_index"] = $_POST["option_index"];

if (strlen($_POST["project_name"]) > 0) {
  $_SESSION["project_name"] = $_POST["project_name"];
} else {
  $_SESSION["project_name"] = "project_name";
}

if (strlen($_POST["database_name"]) > 0) {
  $_SESSION["database_name"] = $_POST["database_name"];
} else if(strlen($_POST["database_name"]) == 0){
  $_SESSION["database_name"] = "database_name";
}

if (strlen($_POST["database_hostname"]) > 0) {
  $_SESSION["database_hostname"]= $_POST["database_hostname"];
} else if(strlen($_POST["database_hostname"]) == 0){
  $_SESSION["database_hostname"] = "database_hostname";
}

if (strlen($_POST["database_username"]) > 0) {
  $_SESSION["database_username"]= $_POST["database_username"];
} else if(strlen($_POST["database_username"]) == 0){
  $_SESSION["database_username"] = "database_username";
}

if (strlen($_POST["database_password"]) > 0) {
  $_SESSION["database_password"] = $_POST["database_password"];
} else if(strlen($_POST["database_password"]) == 0){
  $_SESSION["database_password"] = "database_password";
}

if (strlen($_POST["option_bs"]) == NULL) {
  $_SESSION["option_bs"] = false;
} else {
  $_SESSION["option_bs"] = true;
}

if (strlen($_POST["option_fa"]) == NULL) {
  $_SESSION["option_fa"] = false;
} else {
  $_SESSION["option_fa"] = true;
}

if (strlen($_POST["option_img"]) == NULL) {
  $_SESSION["option_img"] = false;
} else{
  $_SESSION["option_img"] = true;
}

if (strlen($_POST["option_index"]) == NULL) {
  $_SESSION["option_index"] = false;
} else {
  $_SESSION["option_index"] = true;
}

?>

<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Very light weight php framwork.">
  <meta name="author" content="Ibrahim ADLANI">
  <title>LePetitFramework</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/8e5a240d2c.js" crossorigin="anonymous"></script>
  <link href="css/master.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
  <script src="js/main.js"></script>
</head>

<body class="d-flex h-100 text-center">

  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0"><span class="badge bg-warning text-dark">LePetitFramework</span></h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link" href="index.php">Home</a>
          <a class="nav-link" href="information.php">Informations</a>
          <a class="nav-link" target="_blank" href="ibrahimadlani.fr">Contact</a>
        </nav>
      </div>
    </header>

    <main class="px-3">
      <form action="LePetitFramework.php" method="post">
        <h1 class="fw-bold text-start">Table informations</h1>
        <hr>
        <?php for ($i = 1; $i <= $_POST["table_number"]; $i++) { ?>
          <div class="row mt-2">
            <div class="col-4">
              <div class="form-floating">
                <input type="text" class="form-control border-warning" id="" name="tables<?php echo $i; ?>" required>
                <label for="floatingInput">Table name <?php echo $i; ?></label>
              </div>
            </div>
            <div class="col-8">
              <div class="form-floating">
                <input type="text" class="form-control border-warning" id="" name="columns<?php echo $i; ?>" required>
                <label for="floatingInput">Columns (separated by semi-columns)</label>
              </div>
            </div>
          </div>
          <hr>
        <?php } ?>
        <div class="">
          <a href="index.php" class="btn btn btn-outline-dark rounded-pill px-5  shadow-sm"><i class="fas fa-chevron-left"></i> Back</a>
          <button type="sumbit" class="btn btn-warning rounded-pill px-5 shadow-sm"> Download <i class="fas fa-download"></i></button>
        </div>
      </form>
    </main>

    <footer class="mt-auto ">
      <p>Developed by <a href="https://ibrahimadlani.fr/" class="text-warning">Ibrahim</a></p>
    </footer>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>