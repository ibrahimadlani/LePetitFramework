<?php
  require_once('config/db.php');
  require_once('lib/pdo_db.php');
  require_once('models/Item.php');

  ${{TABLENAME}} = new {{TABLENAME}}();
  $all{{TABLENAME}} = ${{TABLENAME}}->get{{TABLENAME}}();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>{{PROJECTTITLE}}</title>
  </head>
  <body>
  <h1 class="fw-bold text-center">{{PROJECTTITLE}}</h1>
  <hr>
  <div class="container mt-4">
    <h3 class="fw-bold text-center">{{TABLENAME}}</h3>
    <hr>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{COLUMN}}</th>

          
        </tr>
      </thead>
      <tbody>
        <?php foreach($all{{TABLENAME}} as $x): ?>
          <tr>
            <td><?php echo $x->id; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>