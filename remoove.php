<?php
function select($query, $data='') :array {

    if (!$query) {
        echo throw new Error("query is empty");
    }else if (empty($data)){
        $query = $query . " ". $this->table;
        $this->query($query);
        return ['data'=>$this->getAll(),'class'=>$this];
    }else if (!empty($data) && is_array($data)) {
        $query = $query . " ". $this->table;

        $this->query($query);
        $data = $this->dataProcess($data);
        return ['data'=>$this->getAll(),'class'=>$this];
    }

    return ["database erroor"];
}

function insert($query, $data) :array {

    if (!$query) {
        echo throw new Error("query is empty");
    }else if (!empty($data) && is_array($data)) {
        $this->query($query);
        $data = $this->dataProcess($data);
        $this->exc();
        return ['this'=>$this];
    }

    return [];
}