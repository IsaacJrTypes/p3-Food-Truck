<?php
/*
Need to figure out
[x] how to append addons to item using html with php
[ ] create cart class
    [] subtotal func
    [] tax func
    [] total func

*/


//Class Item
class Item
{
    public $ID = 0;
    public $name = '';
    public $description = '';
    public $price = 0;
    public $quantity = 0;
    public $addon = array();

    public function __construct($ID, $name, $description, $price)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getID() 
    {
        return $this->ID;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function getPrice() 
    {
        return $this->price;
    }

    public function getAddon()
    {
        return $this->addon;
    }

    public function setAddon($addon)
    {
        foreach($addon as $item) {
        $this->addon[] = $item;
        }
    }
    
    public function setQuant($num) 
    {   // hint typing: forces storage to int
        $this->quantity = (int) $num;
    
    }

    public function getQuant() 
    {
        return $this->quantity;
    }

}

//save new instance to variable
$items = new Item(0,'Spicy Ahi Bowl','Spicy Ahi Tuna, Cucumber, Sweet Onion, Scallion, House Shoyu
Spicy Aioli, Masago ,Pickled Ginger',12.95);
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
        foreach( $menuItems as $key => $item) {?>
        <div class="card">
            <h2><?=$item->getName()?></h2>
            <p><?= $item->getDescription() ?></p>
            <label>Quantity</label>
            <select name="quantity-<?=$key?>">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <div class="addon">
                <input type="checkbox" name="addon-<?= $key?>[]" value="tuna">
                <label for="addon">Add Tuna</label>
                <input type="checkbox" name="addon-<?= $key?>[]" value="rice">
                <label for="addon">Add Rice</label>
                <input type="checkbox" name="addon-<?= $key?>[]" value="onion">
                <label for="addon">Add Onions</label>
            </div>     
        </div>
        
        <?php } // -Used itemID to generate new post key with quantity-ItemID. ?>
    
    </div>
    <button type="submit">Submit</button>
    <button type="reset" onClick="window.location.href='<?= $_SERVER['PHP_SELF'] ?>'" >Reset</button>
    </form>
    <?php
    //Grab form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //if post item is set
        for ( $index=0; $index < count($menuItems); $index++){
        if(!empty($_POST["quantity-{$index}"])) {
            //sets quantity to item object thru method
            $menuItems["{$index}"]->setQuant($_POST["quantity-{$index}"]);
            //adds addon to item object tru method
            if(!empty($_POST["addon-{$index}"])) {
            $menuItems["{$index}"]->setAddon($_POST["addon-{$index}"]);
            }
        } else {
            $_POST["quantity-{$index}"] = null;
        }
    }
        echo '<pre>';
        echo var_dump($_POST);
        echo '##### Post array above, $menuItems obj array below #####<br>';
        echo var_dump($menuItems);
        echo '</pre>';
    }
    ?>

</body>
</html>