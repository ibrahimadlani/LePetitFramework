<?php
session_start();


$tables_names = array();
$tables_rows = array();
$tables_rows_splitted = array();


foreach ($_POST as $key => $value) {
    if (substr($key, 0, 6) == "tables") {
        array_push($tables_names, $value);
    } else if (substr($key, 0, 7) == "columns") {
        array_push($tables_rows, $value);
    }
}

foreach ($tables_rows as $key) {
    $oui = explode(";", $key);
    array_push($tables_rows_splitted, $oui);
}




/*echo "<br>--------------------------<br>";
echo "Nom du projet : " . $_SESSION["project_name"] . "<br>";
echo "Nombre de table : " . $_SESSION["table_number"] . "<br>";
echo "Nom de la BDD : " . $_SESSION["database_name"] . "<br>";
echo "Nom de l'hôte: " . $_SESSION["database_hostname"] . "<br>";
echo "Nom d'utilisateur : " . $_SESSION["database_username"] . "<br>";
echo "Mot de passe : " . $_SESSION["database_password"] . "<br>";

echo "BS4 : " . var_dump($_SESSION["option_bs"]) . "<br>";
echo "FA : " . var_dump($_SESSION["option_fa"]) . "<br>";
echo "IMG : " . var_dump($_SESSION["option_img"]) . "<br>";
echo "Index : " . var_dump($_SESSION["option_index"]) . "<br>";

echo "Noms des tables : " . var_dump($tables_names) . "<br>";
echo "Columns des tables : " . var_dump($tables_rows) . "<br>";
echo "Columns des tables SPLITTED : " . var_dump($tables_rows_splitted) . "<br>";*/





for ($j = 0; $j < sizeof($tables_rows_splitted[$i]); $j++) {
    $name_of_the_row = $tables_rows_splitted[$i][$j];
}



function replaceModel($tableName, $tableRows)
{
    $model = file_get_contents("resource/Item.php");
    $model = str_replace("{{TABLENAME}}", $tableName, $model);


    $attributes = "`" . $tableRows[0] . "`";
    for ($i = 1; $i < sizeof($tableRows); $i++) {
        $attributes = $attributes + ", `" . $tableRows[$i] . "`";
    }


    $datas = ":" . $tableRows[0];
    for ($i = 1; $i < sizeof($tableRows); $i++) {
        $datas = $datas + " , :" . $tableRows[$i];
    }

    $databinds = "";
    for ($i = 1; $i < sizeof($tableRows); $i++) {
        $databinds = $databinds + '$this->db->bind(": ' . $tableRows[$i] . '" , $data["' . $tableRows[$i] . ']");';;
    }
    $model = str_replace("{{ATTRIBUTES}}", $attributes, $model);
    $model = str_replace("{{DATAS}}", $datas, $model);
    $model = str_replace("{{BINDVALUES}}", $databinds, $model);
    echo $model . "<br>";

    //return $model; 
}

replaceModel($tables_names[0], $tables_rows_splitted[0]);
function createTemplate()
{


    /*$db = str_replace("{{HOSTNAME}}", $database_hostname, $db);
    $db = str_replace("{{USERNAME}}", $database_username, $db);
    $db = str_replace("{{PASSWORD}}", $database_password, $db);
    $db = str_replace("{{DATABASENAME}}", $database_name, $db);*/

    $filename = $_SESSION["project_name"];
    $i = 1;
    while (file_exists("return/" . $filename . "-" . $i)) {
        $i = $i + 1;
    }


    mkdir("return/" . $filename . "-" .  $i, 0777);
    mkdir("return/" . $filename . "-" .  $i . "/img", 0777, true);
    mkdir("return/" . $filename . "-" .  $i . "/css", 0777);
    mkdir("return/" . $filename . "-" .  $i . "/js", 0777);
    mkdir("return/" . $filename . "-" .  $i . "/font", 0777);
    mkdir("return/" . $filename . "-" .  $i . "/inc", 0777);
    mkdir("return/" . $filename . "-" .  $i . "/config", 0777);
    mkdir("return/" . $filename . "-" .  $i . "/lib", 0777);
    mkdir("return/" . $filename . "-" .  $i . "/models", 0777);

    file_put_contents("return/" . $filename . "-" .  $i  . "/css/master.css", file_get_contents("resource/master.css"));

    file_put_contents("return/" . $filename . "-" .  $i  . "/js/app.js", file_get_contents("resource/app.js"));

    file_put_contents("return/" . $filename . "-" .  $i  . "/config/pdo_db.php", file_get_contents("resource/pdo_db.php"));

    $db = file_get_contents("resource/db.php");
    $db = str_replace("{{HOSTNAME}}", $_SESSION["database_hostname"], $db);
    $db = str_replace("{{USERNAME}}", $_SESSION["database_username"], $db);
    $db = str_replace("{{PASSWORD}}", $_SESSION["database_password"], $db);
    $db = str_replace("{{DATABASENAME}}", $_SESSION["database_name"],  $db);
    file_put_contents("return/" . $filename . "-" .  $i  . "/models/Item.php", file_get_contents("resource/Item.php"));


    
    $db = file_get_contents("resource/db.php");
    $db = str_replace("{{HOSTNAME}}", $_SESSION["database_hostname"], $db);
    $db = str_replace("{{USERNAME}}", $_SESSION["database_username"], $db);
    $db = str_replace("{{PASSWORD}}", $_SESSION["database_password"], $db);
    $db = str_replace("{{DATABASENAME}}", $_SESSION["database_name"],  $db);
    file_put_contents("return/" . $filename . "-" .  $i  . "/lib/db.php", $db);


}

createTemplate();





/*$project_name = $_POST["project_name"];

$database_name = $_POST["database_name"];
$database_username = $_POST["database_username"];
$database_password = $_POST["database_password"];
$database_hostname = $_POST["database_hostname"];

$table_number = $_POST["table_number"];


$index = file_get_contents('resource/index.php');
$db = file_get_contents('resource/db.php');
$Object = file_get_contents('resource/Object.php');
$readme = file_get_contents('resource/readme.php');

$db = str_replace($database_hostname, "{{HOSTNAME}}", $db);
$db = str_replace($database_username, "{{USERNAME}}", $db);
$db = str_replace($database_password, "{{PASSWORD}}", $db);
$db = str_replace($database_name, "{{DATABASENAME}}", $db);
file_put_contents('db.php', $db);

$STRING_require = "";
$STRING_instance = "";
$STRING_table_header = "";
$STRING_table_rows = "";
$STRING_table = "";


for ($i = 0; $i < $table_number; $i++) {
    $name_of_the_table = $tables_names[$i];

    for ($j = 0; $j < $tables_rows[$i]; $j++) {
        $name_of_the_row = $tables_rows[$i][$j];
    }
}

$index = str_replace($project_name, "{{PROJECTTITLE}}", $index);
$index = str_replace($project_name, "{{PROJECTTITLE}}", $index);
$index = str_replace($project_name, "{{PROJECTTITLE}}", $index);
$index = str_replace($project_name, "{{PROJECTTITLE}}", $index);
file_put_contents('index.php', $index);

$Object = str_replace($project_name, "{{PROJECTTITLE}}", $Object);
$Object = str_replace($project_name, "{{PROJECTTITLE}}", $Object);
$Object = str_replace($project_name, "{{PROJECTTITLE}}", $Object);
$Object = str_replace($project_name, "{{PROJECTTITLE}}", $Object);
file_put_contents('Object.php', $Object);



$readme = str_replace($project_name, "{{PROJECTTITLE}}", $readme);
$readme = str_replace($project_name, "{{PROJECTTITLE}}", $readme);
$readme = str_replace($project_name, "{{PROJECTTITLE}}", $readme);
$readme = str_replace($project_name, "{{PROJECTTITLE}}", $readme);
file_put_contents('readme.php', $readme);
*/
//header("Location: thankyou.php");