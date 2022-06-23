<?php

class Database
{


    const host = "localhost";
    const dbname = "test";
    const name = "root";
    const pass = '';


    private static $database;
    private $db;
    private $stmt;
    private $table;


    function __construct()
    {

        try {
            $this->db = new PDO("mysql:host=" . self::host . ";dbname=" . self::dbname, self::name, self::pass);
            $this->db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (\Exception $th) {
            die("database error");
        }

    }

    static function database()
    {
        self::$database = new Database();
        return self::$database;
    }


    function query($q)
    {
        $this->stmt = $this->db->prepare($q);
    }

    function bind($key, $value)
    {
        $this->stmt->bindValue($key, $value);
    }

    function exc()
    {
        return $this->stmt->execute();
    }

    function count()
    {
        return $this->stmt->rowCount();
    }

    function getSingle()
    {
        self::exc();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    function getAll()
    {
        self::exc();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }


    function dataProcess(array $data): string
    {
        $counter = 1;
        if (array_keys($data) !== range(0, count($data) - 1)) {
            //associative array
            foreach ($data as $index => $value) {
                $this->bind(":$index", $value);
            }
            return "asso";
        } else {
            //sequentail array
            foreach ($data as $value) {

                $this->bind($counter, $value);

                $counter++;
            }
            return 'sequ';
        }
    }


    function select($query, $data = ''): array|Database
    {

        if (!$query) {
            echo throw new Error("query is empty");
        } else if (empty($data)) {

            $this->query($query);
            $this->exc();
            return $this;
        } else if (!empty($data) && is_array($data)) {


            $this->query($query);
            $data = $this->dataProcess($data);
            $this->exc();
            return $this;
        }

        return ['error'];
    }

    function insert($query, $data): array|Database
    {

        if (!$query) {
            echo throw new Error("query is empty");
        } else if (!empty($data) && is_array($data)) {
            $this->query($query);
            $data = $this->dataProcess($data);
            $this->exc();
            return $this;
        }

        return ['error'];
    }

    function update($query, $data = ''): array|Database
    {

        if (!$query) {
            echo throw new Error("query is empty");
        } else if (empty($data)) {
            $this->query($query);
            $this->exc();
            return $this;
        } else if (!empty($data) && is_array($data)) {
            $this->query($query);
            $data = $this->dataProcess($data);
            $this->exc();
            return $this;
        }

        return ['error'];
    }

    function delete($query, $data): array|Database
    {

        if (!$query) {
            echo throw new Error("query is empty");
        } else if (empty($data)) {
            $this->query($query);
            $this->exc();
            return $this;
        } else if (!empty($data) && is_array($data)) {
            $this->query($query);
            $data = $this->dataProcess($data);
            $this->exc();
            return $this;
        }


        return ['error'];
    }


    function get(): array
    {
        return $this->getAll();
    }

    function First(): object{
        return $this->getSingle();
    }

    function getCount(): int|array
    {
        return $this->count();
    }


}

//$d = new Database();
//$d->query("select * from hello");
//$data = $d->getAll();
//var_dump($data)
//$hello = $d->select("select * from h1 where id =? and name = ?", [43, "ahmed"])->get();
//$hello = $d->select("select * from h1 where id =? and name = ?", [43, "ahmed"])->get();
//$hello = $d->select("select * from hello where name = :name",['name'=>"mohamedahmed"])['data'];
//$hello = $d->insert("insert into h1(name) values (:name)",['name'=>"mohamedahmed"])->select("select * from h1")->get();
//$hello = $d->update("update h1 set name= :name where id = :id", ['name' => "ahmed22", 'id' => 22])->select('select * from h1')->get();
//$hello = $d->select("select * from h1")->First();



