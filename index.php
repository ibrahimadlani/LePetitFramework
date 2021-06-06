<?php session_start();?>
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
          <a class="nav-link">Home</a>
          <a class="nav-link" href="#">Informations</a>
          <a class="nav-link" href="#">Contact</a>
        </nav>
      </div>
    </header>

    <main class="px-3">
      <h1 class="display-2">Very light weight PHP framework</h1>
      <p class="lead">You should use LePetitFramework if you're embarking on a smaller project or just don't feel like you need all the utility of larger frameworks.</p>
      <button class="btn btn-lg rounded-pill btn-warning px-5" data-bs-toggle="modal" data-bs-target="#form">Let's try</button>
    </main>
    <form method="POST" action="laststep.php" class="modal fade" id="form" tabindex="-1" aria-labelledby="form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <h5 class="modal-title lead" id="exampleModalLabel">Let's begin !</h5>
          </div>
          <div class="modal-body">
            <h3 class="mb-0 text-start"><span class="badge bg-warning text-dark">Database</span></h3>
            <hr>
            <div class="row">
              <div class="col-8">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control border-warning" name="project_name" placeholder="Project name" required>
                  <label for="floatingInput">Project name</label>
                </div>
              </div>
              <div class="col-4">
                <div class="form-floating mb-3">
                  <input type="number" class="form-control border-warning" name="table_number" min="1" max="10" required>
                  <label for="floatingInput"># of table</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control border-warning" name="database_name" placeholder="Database name">
                  <label for="floatingInput">Database name</label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control border-warning" name="database_hostname" placeholder="name@example.com">
                  <label for="floatingInput">Hostname</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control border-warning" name="database_username" placeholder="name@example.com">
                  <label for="floatingInput">Username</label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="password" class="form-control border-warning" name="database_password" placeholder="name@example.com">
                  <label for="floatingInput">Password</label>
                </div>
              </div>
            </div>
            <h3 class="mb-0 text-start mt-3"><span class="badge bg-warning text-dark">Addons</span></h3>
            <hr>
            <div class="row">
              <div class="col"><input type="checkbox" class="btn-check" id="btn-check1" autocomplete="off" name="option_bs">
                <label class="btn btn-lg btn-outline-warning rounded-pill" for="btn-check1"><i class="fab fa-bootstrap"></i></label>
              </div>
              <div class="col"><input type="checkbox" class="btn-check" id="btn-check2" autocomplete="off" name="option_fa">
                <label class="btn btn-lg btn-outline-warning rounded-pill" for="btn-check2"><i class="fab fa-font-awesome-flag"></i></label>
              </div>
              <div class="col"><input type="checkbox" class="btn-check" id="btn-check3" autocomplete="off" name="option_img">
                <label class="btn btn-lg btn-outline-warning rounded-pill" for="btn-check3"><i class="fas fa-file-image"></i></label>
              </div>
              <div class="col"><input type="checkbox" class="btn-check" id="btn-check4" autocomplete="off" name="option_index">
                <label class="btn btn-lg btn-outline-warning rounded-pill" for="btn-check4"><i class="fas fa-file-code"></i></label>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button class="btn btn-sm rounded-pill btn-outline-dark px-5" data-bs-dismiss="modal"><i class="fas fa-arrow-left"></i> Back</button>
            <button class="btn btn-sm rounded-pill btn-warning px-5">Next <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
      </div>
    </form>



    <footer class="mt-auto ">
      <p>Developed by <a href="https://ibrahimadlani.fr/" class="text-warning">Ibrahim</a></p>
    </footer>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>