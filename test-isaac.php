<?php
/*
Need to figure out
- how to append addons to item using html with php

*/


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
        foreach($addon as $item) {
        $this->addon[] = $item;
        }
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

$items = new Item(2,'Pike Place Bowl','Salmon, Sweet Onion, Cucumber, Sesame Seeds, House Shoyu, Edamame, Crunchy Onion',14.95);
$menuItems[]= $items;

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
        <?php 
        //grabs $menuItem array -> sets item
        foreach( $menuItems as $item) {?>
        <div class="card">
            <h2><?=$item->name?></h2>
            <p><?= $item->description ?></p>
            <label>Quantity</label>
            <select name="quantity-<?= $item->ID?>">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <div class="addon">
                <input type="checkbox" name="addon-<?= $item->ID?>[]" value="tuna">
                <label for="addon">Add Tuna</label>
                <input type="checkbox" name="addon-<?= $item->ID?>[]" value="rice">
                <label for="addon">Add Rice</label>
                <input type="checkbox" name="addon-<?= $item->ID?>[]" value="onion">
                <label for="addon">Add Onions</label>
            </div>     
        </div>
        
        <?php }
        // -Used itemID to generate new post key with quantity-ItemID. ?>
        
        
        
    
    </div>
    <button type="submit">Submit</button>
    <button type="reset" onClick="window.location.href='<?= $_SERVER['PHP_SELF'] ?>'" >Reset</button>
    </form>
    <?php
    //Grab form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //if post item is set
        foreach($menuItems as $index => $item){
        if(!empty($_POST["quantity-{$index}"])) {
            //add addon to item object
            $menuItems["{$index}"]->addon($_POST["addon-{$index}"]);
        } else {
            $_POST["quantity-{$index}"] = null;
        }
    }
        echo '<pre>';
        echo var_dump($_POST);
        echo '<p>Post above, $menuItems array below</p>';
        echo var_dump($menuItems);
        echo '</pre>';
    }
    ?>

</body>
</html>