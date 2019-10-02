<?php

class DBobj
{

    public $conn;

    public function getConnString()
    {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$con) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "<br />";
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "<br />";
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        } else {
            $this->conn = $con;
        }

        return $this->conn;
    }
}

class Crud
{

    protected $conn;

    function __construct($connString)
    {
        $this->conn = $connString;
    }

    function create($table_name, $field, $data)
    {
        $i = $j = 0;

        foreach ($field as $a) {
            $printField[$i] = $a;
            ++$i;
        }
        $dataField = implode(", ", $printField);

        foreach ($data as $b) {
            $printVal[$j] = "'" . addslashes($b) . "'";
            ++$j;
        }
        $dataArray = implode(", ", $printVal);

        $sql = "insert into $table_name ";
        $sql .= "($dataField) values($dataArray)";

        // echo $sql;
        // exit();

        $query = mysqli_query($this->conn, $sql) or die('ERROR_I');
        // print_r($query);
        return $query;
    }

    public function read($field, $from, $join, $where, $order)
    {

        if (count($field) > 0) {
            foreach ($field as $key => $value) {
                $read[] = $value;
            }
        }

        $field = implode(", ", $read);

        $sql = "select $field from $from";
        if (!empty($join)) {
            $sql .= ' ' . $join;
        }

        if (!empty($where)) {
            $sql .= " where $where ";
        }

        if (!empty($order)) {
            $sql .= " order by $order ";
        }
        // echo $sql;
        // exit();
        $query = mysqli_query($this->conn, $sql) or die('Error Select Data');
        return $query;
    }

    function update($table_name, $data, $where)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $value = addslashes($value);
                $value = "'$value'";
                $update[] = "$key = $value";
            }
        }

        $array_data = implode(", ", $update);
        $sql = "update $table_name set ";
        $sql .= $array_data;
        $sql .= " where $where";

        $query = mysqli_query($this->conn, $sql) or die('Error update data');
        return $query;
    }

    function delete($table_name, $data)
    {
        $sql = "delete from " . $table_name . " ";
        $sql .= "where " . $data;

        $query = mysqli_query($this->conn, $sql) or die();
        return $query;
    }
}

class Main extends Controller
{
    

    function getPage()
    {
        if (!isset($_GET['page'])) {
            $this->view('home');
        } else {
            $pages = htmlentities($_GET['page']);

            if (file_exists('app/views/' . $pages . '.php')) {
                $this->view($pages);
            } elseif ($pages == "logout") {
                echo '<meta http-equiv="refresh" content="0;url=index.php">';
                session_destroy();
            } else {
                $this->view('404');
            }
        }
    }

    function getMain()
    {
        $this->view('header');
        $this->sideBar('menu');
        $this->getPage();
        $this->view('footer');
    }

    function getLogin()
    {
        $this->view('login');
    }

    public function actInterview($id)
    {
        $db = new DBobj();
        $connString = $db->getConnString();
        $cek = new Interview($connString);
        
        $actBtn = '<div class="form-group text-center">';
        $actBtn .= '<select name="modalAct" id="modalAct" class="modalAct">';
        $actBtn .= '<option value="">Action</option>';
        // $actBtn .= '<option value="edit" data-id="'.$id.'" style="display: none">Edit</option>';
        // if ($cek->cekMemilih($id) == 0) {
            $actBtn .= '<option value="interview" data-id="'.$id.'">Interview</option>';
        // }
        $actBtn .= '</select>';
        $actBtn .= '</div>';

        return $actBtn;
    }
}

class Interview {
    protected $conn;

    public function __construct($connString)
    {
        $this->conn = $connString;
    }

    public function cekMemilih($id)
    {
        $sql = 'select memilih ';
        $sql .= 'from dpt ';
        $sql .= "where kode_dpt = '$id'";
        $query = mysqli_query($this->conn, $sql) or die('data not found');
        $result = mysqli_fetch_assoc($query);

        return $result['memilih'];
    }

    public function getIdPemilih($id)
    {
        $sql = 'select id ';
        $sql .= 'from m_interview ';
        $sql .= "where pemilih_id = '$id'";
        $query = mysqli_query($this->conn, $sql) or die('data not found');
        $result = mysqli_fetch_assoc($query);

        return $result['id'];
    }

    public function getPemilihId($id)
    {
        $sql = 'select pemilih_id ';
        $sql .= 'from m_interview ';
        $sql .= "where id = '$id'";
        $query = mysqli_query($this->conn, $sql) or die('data not found');
        $result = mysqli_fetch_assoc($query);

        return $result['pemilih_id'];
    }
}