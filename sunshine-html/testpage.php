<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bestelformulier</title>
    </head>

    <body>
<!--
    <style>
        // Define a variable for the primary color
        $primary-color: #007bff;

        // Define a mixin for creating box shadows
        @mixin box-shadow($x, $y, $blur, $color) {
        box-shadow: $x $y $blur $color;
        }

        // Define a class for a button
        .btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: $primary-color;
        color: #fff;
        border-radius: 4px;
        text-decoration: none;
        
        // Use the mixin to add a box shadow to the button
        @include box-shadow(0px, 2px, 4px, rgba(0,0,0,0.2));
        
        // Add a hover state to the button
        &:hover {
            background-color: darken($primary-color, 10%);
        }
        }
    </style>
-->
        <h2>Bestellen</h2>
        <form action="verwerken.php" method="post" id="request">
            <fieldset>
                <legend>Uw order</legend>
                <hr>
                <p>
                    <label for="product">Uw product : </label>
                    <?php
                    // Connectie creëeren
                    $conn = new mysqli("localhost", "root", "", "gip"); 
                    // Connectie checken
                    if ($conn->connect_errno) {
                        die("Connectie mislukt: " . $conn->connect_error);
                    }

                    $result = $conn->query("SELECT product_naam FROM product");
                    echo "<select name='product_lijst' id='product' onchange='myFunction()'>";
            
                    while ($row = $result->fetch_assoc()) {
                        unset($name);
                        $name = $row["product_naam"];
                        echo '<option value="'.$name.'">'.$name.'</option>';
                    }
                    echo "</select>";
        
                    if (empty($_COOKIE["gekozenProduct"]) != true) {
                        $gekozenProduct = $_COOKIE["gekozenProduct"];
                        $result = $conn->query("SELECT product_prijs FROM product WHERE product_naam = '".mysqli_real_escape_string($conn, $gekozenProduct)."'");
                    }

                    while($row = $result->fetch_assoc()) {
                        $_COOKIE["price"] = $row["product_prijs"];
                    }
        
                    $conn->close();
                    ?>
                </p>
                <p>
                    <label for="price">Prijs (in euro): </label>
                    <input type="number" id="price" name="price" value="<?php if (empty($_COOKIE["price"]) != true) { echo $_COOKIE["price"]; } ?>" min="<?php if (empty($_COOKIE["price"]) != true) { echo $_COOKIE["price"]; } ?>" max="300" step="<?php if (empty($_COOKIE["price"]) != true) { echo $_COOKIE["price"]; } ?>"><br><br>
                </p>
                <p>
                    <label for="email">Email : </label>
                    <input type="email" id="email" name="email"><br><br>
                </p>
                <p>
                    <label for="birthday">Birthday : </label>
                    <input type="date" id="birthday" name="birthday"><br><br>
                </p>
                <input class="btn" type="submit" value="Submit"><br>
            </fieldset>
        </form>
        <fieldset>
            <legend>Al de variabelen</legend>
            <hr>
            <?php
            if (empty($_COOKIE["gekozenProduct"]) != true) {
                echo "Het geselecteerde product zou " . $_COOKIE["gekozenProduct"] . " moeten zijn.<br>";
            } else {
                echo "We konden het geselecteerde product niet aflezen.<br>";
            }

            if (empty($_COOKIE["price"]) != true) {
                echo "De prijs zou " . $_COOKIE["price"] . " moeten zijn.<br>";
            } else {
                echo "We konden de prijs van het geselecteerde product niet aflezen.<br>";
            }
            ?>
            Dit is het product dat we konden aflezen: <div id="demo"></div>
        </fieldset>
        
        <script>
            function myFunction() {
            var x = document.getElementById("product").value;
            document.getElementById("demo").innerHTML = x;
            document.cookie = "gekozenProduct = " + x;
            }
        </script>
        <script>
            //Dit script werkt niet maar ik wil het bijhouden
         // Creating a cookie after the document is ready
         val = document.getElementById("product").value;
         $(document).ready(function () {
            createCookie("selectProduct", val, "10");
         });

         // Function to create the cookie
         function createCookie(name, value, days) {
            var expires;
            if (days) {
               var date = new Date();
               date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
               expires = "; expires=" + date.toGMTString();
            }
            else {
               expires = "";
            }
            document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
         }
         function selection() {
            val = document.getElementById("product").value;
            $(document).ready(function () {
               createCookie("selectProduct", val, "10");
            });
            <?php
            // Connectie creëeren
            $conn = new mysqli("localhost", "root", "", "gip"); 
            // Connectie checken
            if ($conn->connect_errno) {
               die("Connectie mislukt: " . $conn->connect_error);
            }
            //$result = $conn->query("SELECT product_prijs FROM product WHERE product_naam = '".mysqli_real_escape_string($conn, $_COOKIE['phpVar'])."'");
            $result = $conn->query("SELECT product_prijs FROM product WHERE product_naam = '".mysqli_real_escape_string($conn, $_COOKIE['selectProduct'])."'");
            while($row = $result->fetch_assoc()) {
               $price = $row["product_prijs"];
            }
            $conn->close();
            ?>
            
            alert("uw prijs zou " + "<?php echo $_COOKIE["selectProduct"]; ?>" + " moeten zijn.");
         }
      </script>
    </body>
</html>