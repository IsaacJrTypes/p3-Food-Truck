<?php
//Class Item
class Item
{
    public $ID = 0;
    public $name = '';
    public $description = '';
    public $price = 0;

    public function __construct($ID, $name, $description, $price)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

}

//Grab form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<pre>';
    echo var_dump($_POST);
    echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./styles.css">
    <title>Document</title>
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="card-container">
        <div class="card">
            <h2>Item Name</h2>
            <p>Description of item</p>
            <label>Quantity</label>
            <select name="quantity">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>

            </select>     
        </div>
    </div>
    <button type="submit">Submit</button>
    </form>

</body>
</html>