<?php
session_start();

//initialisation des varilables
$tables_names = array();
$tables_rows = array();
$tables_rows_splitted = array();

//récupération des valeurs des tables et des colonnes du post
foreach ($_POST as $key => $value) {
    if (substr($key, 0, 6) == "tables") {
        array_push($tables_names, $value);
    } else if (substr($key, 0, 7) == "columns") {
        array_push($tables_rows, $value);
    }
}

//parse le nom des colonnes en une liste assiociative
foreach ($tables_rows as $key) {
    $oui = explode(";", $key);
    array_push($tables_rows_splitted, $oui);
}

//affichage des informations
// echo "<br>--------------------------<br>";
// echo "Nom du projet : " . $_SESSION["project_name"] . "<br>";
// echo "Nombre de table : " . $_SESSION["table_number"] . "<br>";
// echo "Nom de la BDD : " . $_SESSION["database_name"] . "<br>";
// echo "Nom de l'hôte: " . $_SESSION["database_hostname"] . "<br>";
// echo "Nom d'utilisateur : " . $_SESSION["database_username"] . "<br>";
// echo "Mot de passe : " . $_SESSION["database_password"] . "<br>";

// echo "BS4 : " . var_dump($_SESSION["option_bs"]) . "<br>";
// echo "FA : " . var_dump($_SESSION["option_fa"]) . "<br>";
// echo "IMG : " . var_dump($_SESSION["option_img"]) . "<br>";
// echo "Index : " . var_dump($_SESSION["option_index"]) . "<br>";

// echo "Noms des tables : " . var_dump($tables_names) . "<br>";
// echo "Columns des tables : " . var_dump($tables_rows) . "<br>";
// echo "Columns des tables SPLITTED : " . var_dump($tables_rows_splitted) . "<br>";


//vérifier si cette fonction est vitale
// for ($j = 0; $j < sizeof($tables_rows_splitted[$i]); $j++) {
//     $name_of_the_row = $tables_rows_splitted[$i][$j];
// }

//fonction permettant de créer un model à partir d'un model template, d'un nom de table et d'une liste de colonnes correspondantes
function replaceModel($tableName, $tableRows)
{
    //crée les champs des attributs en fonctions des noms des colonnes
    $attributes = "`" . $tableRows[0] . "`";
    for ($i = 1; $i < sizeof($tableRows); $i++) {
        $attributes = $attributes . ", `" . $tableRows[$i] . "`";
    }

    //crée les champs des datas en fonctions des noms des colonnes
    $datas = ":" . $tableRows[0];
    for ($i = 1; $i < sizeof($tableRows); $i++) {
        $datas = $datas . " , :" . $tableRows[$i];
    }

    //crée les champs des binds en fonctions des noms des colonnes
    $databinds = "";
    for ($i = 1; $i < sizeof($tableRows); $i++) {
        $databinds = $databinds . '$this->db->bind(": ' . $tableRows[$i] . '" , $data["' . $tableRows[$i] . '"]);';
    }

    //crée les champs des set de data en fonctions des noms des colonnes
    $dataSet = "";
    for ($i = 0; $i < sizeof($tableRows); $i++) {
        $dataSet = $dataSet . "`" . $tableRows[$i] . "` = '. $" . $tableRows[$i] . " .'" . ", ";
    }
    $dataSet = substr($dataSet, 0, -3);

    //crée les champs des attributs en fonctions des noms des colonnes
    $dataSetAttributes = "$" . $tableRows[0];
    for ($i = 1; $i < sizeof($tableRows); $i++) {
        $dataSetAttributes = $dataSetAttributes . ", $" . $tableRows[$i];
    }

    //récupère le contenu du model
    $model = file_get_contents("../resource/Item.php");

    //remplace tous les champs model par ceux créer plus haut
    $model = str_replace("{{TABLENAME}}", $tableName, $model);
    $model = str_replace("{{ATTRIBUTES}}", $attributes, $model);
    $model = str_replace("{{DATAS}}", $datas, $model);
    $model = str_replace("{{BINDVALUES}}", $databinds, $model);
    $model = str_replace("{{DATASET}}", $dataSet, $model);
    $model = str_replace("{{DATASETATTRIBUTES}}", $dataSetAttributes, $model);

    return $model; 
}

//fonction créant le template
function createTemplate($models, $tablesName, $tablesRows)
{
    /*$db = str_replace("{{HOSTNAME}}", $database_hostname, $db);
    $db = str_replace("{{USERNAME}}", $database_username, $db);
    $db = str_replace("{{PASSWORD}}", $database_password, $db);
    $db = str_replace("{{DATABASENAME}}", $database_name, $db);*/

    //récupère le nom du projet
    $filename = $_SESSION["project_name"];

   
    $i = "";
    $cpt = 0;

    //vérifie si un fichier de même nom existe déja sur le serveur
    if(file_exists("return/" . $filename)){  
        while (file_exists("return/" . $filename . $i)) { //si oui, il essaye "nomDuFichier-ValeurCpt". Tant qu'un fichier sera déjà présent sous le même nom il incrémente le compteur et recommence
            $cpt++;
            $i = "-" . $cpt;
        }
    }else{ //sinon l'index sera vide
        $i = "";
    }

    //crée les dossiers du projet
    mkdir("return/" . $filename . $i, 0777);
    mkdir("return/" . $filename . $i . "/img", 0777, true);
    mkdir("return/" . $filename . $i . "/css", 0777);
    mkdir("return/" . $filename . $i . "/js", 0777);
    mkdir("return/" . $filename . $i . "/font", 0777);
    mkdir("return/" . $filename . $i . "/inc", 0777);
    mkdir("return/" . $filename . $i . "/config", 0777);
    mkdir("return/" . $filename . $i . "/lib", 0777);
    mkdir("return/" . $filename . $i . "/models", 0777);

    //rempli certains fichier du projet à partir des models de ressource
    file_put_contents("return/" . $filename . $i  . "/css/master.css", file_get_contents("../resource/master.css"));

    file_put_contents("return/" . $filename . $i  . "/js/app.js", file_get_contents("../resource/app.js"));

    file_put_contents("return/" . $filename . $i  . "/config/pdo_db.php", file_get_contents("../resource/pdo_db.php"));

        
    $db = file_get_contents("../resource/db.php");
    $db = str_replace("{{HOSTNAME}}", $_SESSION["database_hostname"], $db);
    $db = str_replace("{{USERNAME}}", $_SESSION["database_username"], $db);
    $db = str_replace("{{PASSWORD}}", $_SESSION["database_password"], $db);
    $db = str_replace("{{DATABASENAME}}", $_SESSION["database_name"],  $db);
    file_put_contents("return/" . $filename . $i  . "/lib/db.php", $db);

    //parcours chaque tables pour créer les champs de la page d'affichage des données des tables dans un tableau
    for ($j=0; $j < sizeof($tablesName); $j++) { 
        $column = "";
        foreach($tablesRows[$j] as $row){
            $column .= "<th>$row</th>
            ";
        }

        //chaque table a une page php à son nom où sont afficher les données de la table dans un tableau
        $index = file_get_contents("../resource/index.php");
        $index = str_replace("{{PROJECTTITLE}}", $_SESSION["project_name"], $index);
        $index = str_replace("{{TABLENAME}}", $tablesName[$j], $index);
        $index = str_replace("{{COLUMN}}", $column, $index);
        file_put_contents("return/" . $filename . $i  . "/". $tablesName[$j] .".php", $index);
    }

    //ajoute les balises "<php? " aux models
    for($j = 0; $j < sizeof($tablesName); $j++){
        file_put_contents("return/" . $filename . $i  . "/models/". $tablesName[$j] .".php", str_replace("{{PHP}}", "<?php", $models[$j]));
    }

    //appel fonction création zip
    creationZip("return/" . $filename . $i);

    telechargement("return/" . $filename . $i .".zip");

}

//creation d'un zip a partir du chemin du dossier passer en parametre
function creationZip($cheminDossier){
    $rootPath = realpath($cheminDossier);

    // Creation du fichier zip
    $zip = new ZipArchive();
    //chemin de l'emplacement du fichier zip
    $zip->open("$cheminDossier.zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Creation d'un dossier d'itération recursives
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file)
    {
        if (!$file->isDir())
        {
            // recupère le chemin du fichier en cours
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // ajoute le fichier dans l'archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Fermeture de l'objet pour le créer
    $zip->close();
}

//fonction de téléchargmenet d'un fichier a partir du chemin passé en parametre
function telechargement($cheminFichier){
    $file = $cheminFichier;

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        include "../thankyou.php";
    }
}

//initialise la liste des contenu de chaque model
$models = array();
for($i = 0; $i < sizeof($tables_names); $i++){
    array_push($models, replaceModel($tables_names[$i], $tables_rows_splitted[$i])); //ajoute à la liste de momdels le contenu de chaque model
}

//appel de la fonction de création des template
createTemplate($models, $tables_names, $tables_rows_splitted);





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