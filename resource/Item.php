{{PHP}}
  class {{TABLENAME}} {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function add{{TABLENAME}}($data) {
      // Prepare Query
      $this->db->query('INSERT INTO `{{TABLENAME}}` ({{ATTRIBUTES}}) VALUES({{DATAS}})');

      // Bind Values
      


      {{BINDVALUES}}



      // Execute
      if($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function get{{TABLENAME}}() {
      $this->db->query('SELECT * FROM `{{TABLENAME}}` WHERE 1');

      $results = $this->db->resultset();

      return $results;
    }

    public function get{{TABLENAME}}ById($id) {
      $this->db->query('SELECT * FROM `{{TABLENAME}}` WHERE `id` =' . $id);

      $results = $this->db->resultset();

      return $results;
    }

    public function update{{TABLENAME}}($id, {{DATASETATTRIBUTES}}) {
      $this->db->query('UPDATE `{{TABLENAME}}` SET {{DATASET}} 'WHERE `id` =' .$id);

      $results = $this->db->resultset();

      return $results;
    }

  }