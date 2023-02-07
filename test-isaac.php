<?php
//Class Item
class Item
{
    public $ID = 0;
    public $name = '';
    public $description = '';
    public $price = 0;
    public $addon = array();

    public function __construct($ID, $name, $description, $price)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function addon($addon){
        $this->addon[] = $addon;
    }

}

//save new instance to variable
$items = new Item(0,'Spicy Ahi Bowl','Spicy Ahi Tuna, Cucumber, Sweet Onion, Scallion, House Shoyu
Spicy Aioli, Masago ,Pickled Ginger',12.95);
// $item->addon('Tuna');
// $item->addon('Rice');
// $item->addon('Onions');
$menuItems[]= $items;

$items = new Item(1,'Hawaiian Classic Bowl','Ahi Tuna, Sweet Onion Hijiki (Seaweed), Scallion, House Shoyu Seaweed Salad, Sesame Seeds',13.95);
$menuItems[]= $items;

$items = new Item(2,'Pike Place Bowl','Salmon, Sweet Onion, Cucumber, Sesame Seeds, House Shoyu, Edamame, Crunchy Onion',13.95);
$menuItems[]= $items;

//Grab form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<pre>';
    echo var_dump($_POST);
    echo var_dump($menuItems);
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
        <?php foreach( $menuItems as $item) {
        echo '<div class="card">
            <h2>'. $item->name .'</h2>
            <p>'. $item->description .'</p>
            <label>Quantity</label>
            <select name="quantity'.$item->ID.'">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>     
        </div>';
        }
        ?>
    </div>
    <button type="submit">Submit</button>
    </form>

</body>
</html>