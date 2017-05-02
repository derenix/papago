<pre>
$database = new DB();
</pre>

**INSERT SINGLE QUERY**
<pre>
$database->query('INSERT INTO trips (operator_id, title, price, url_detail) VALUES (:operator_id, :title, :price, :url_detail)');

$database->bind(':operator_id', '666');
$database->bind(':title', 'Reise XY');
$database->bind(':price', '24 Euro');
$database->bind(':url_detail', 'http://google.de');

$database->execute();
echo $database->lastInsertId();
</pre>

**INSERT MULTIPLE QUERIES**
<pre>
$database->beginTransaction();
$database->query('INSERT INTO trips (operator_id, title, price, url_detail) VALUES (:operator_id, :title, :price, :url_detail)');

$database->bind(':operator_id', '666');
$database->bind(':title', 'Reise XY');
$database->bind(':price', '24 Euro');
$database->bind(':url_detail', 'http://google.de');
$database->execute();

$database->bind(':operator_id', '666');
$database->bind(':title', 'Reise XY');
$database->bind(':price', '89 Euro');
$database->bind(':url_detail', 'http://google.de');
$database->execute();

echo $database->lastInsertId();
$database->endTransaction();
</pre>

**SELECT SINGLE**
<pre>
$database->query('SELECT * FROM trips WHERE operator_id = :operator_id');

$database->bind(':operator_id', '666');
$row = $database->single();

print_r($row);
</pre>

**SELECT MULTIPLE**
<pre>
$database->query('SELECT * FROM trips WHERE operator_id = :operator_id');

$database->bind(':operator_id', '666');
$rows = $database->resultset();

print_r($rows);
echo $database->rowCount();
</pre>