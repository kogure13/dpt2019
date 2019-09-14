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

    function actBtn($id, $role)
    {
        switch ($role) {
            case '1':
                return '<div class="btn-group" role="group" aria-label="hidden">
                <a href="#" id="' . $id . '" class="btn btn-xs btn-success btn-act" data-original-title="Edit">
                <i class="fa fa-pencil"></i>
                </a>
                <a href="#" id="' . $id . '" class="btn btn-xs btn-danger btn-act" data-original-title="Delete">
                <i class="fa fa-trash-o"></i>
                </a>
            </div>';
                break;
            case '2':
                break;
            case '3':
                break;
            case '4':
                break;
        }
    }
}
