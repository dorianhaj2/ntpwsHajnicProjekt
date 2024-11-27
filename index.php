<?php 
    session_start();
    $con = mysqli_connect("127.0.0.1", "root", "", "ntpwshajnicprojekt") or die('Error connecting to MySQL server.');

    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }

    if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dorian Hajnić">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="design.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Projekt - Hajnić</title>
</head>
<body>
    <header>
        <div class='hero'></div>
        <nav>
            <?php
                include('nav.php');
            ?>
        </nav>
    </header>
    <main>
        <div class='container'>
            <?php
                # Home
                if (!isset($menu) || $menu == 1) { include("sites/home.php"); }
                
                # All Recipes
                else if ($menu == 2) { include("sites/all_recipes.php"); }
                
                # Register
                else if ($menu == 3) { include("sites/register.php"); }
                
                # Signin
                else if ($menu == 4) { include("sites/signin.php"); }

                # User Recipes
                else if ($menu == 5) { include("sites/user_recipes.php"); }
            
                # Admin
                else if ($menu == 6) { include("sites/admin.php"); }

                # New Recipe
                else if ($menu == 7) { include("sites/add_recipe.php"); }

                # Recipe Details
                else if ($menu == 8) { include("sites/recipe_details.php"); }
            ?>
        </div>
    </main>
    <footer>
        <div class="foot">
            <div class="foot-part">
                <p>Copyright © 2024 - Dorian Hajnić</p>
            </div>
        </div>
	</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>