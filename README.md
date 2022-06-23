# databaseModel

### d = new Database();
### $d->query("select * from hello");
### $data = $d->getAll();
### var_dump($data)
### $hello = $d->select("select * from h1 where id =? and name = ?", [43, "ahmed"])->get();
### $hello = $d->select("select * from h1 where id =? and name = ?", [43, "ahmed"])->get();
### $hello = $d->select("select * from hello where name = :name",['name'=>"mohamedahmed"])['data'];
### $hello = $d->insert("insert into h1(name) values (:name)",['name'=>"mohamedahmed"])->select("select * from h1")->get();
### $hello = $d->update("update h1 set name= :name where id = :id", ['name' => "ahmed22", 'id' => 22])->select('select * from h1')->get();
### $hello = $d->select("select * from h1")->First();



