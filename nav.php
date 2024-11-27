
<ul>
    <li><a href="index.php?menu=1">Home</a></li>
    <li><a href="index.php?menu=2">All Recipes</a></li>
    <?php
        if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
            print '
            <li><a href="index.php?menu=3">Register</a></li>
            <li><a href="index.php?menu=4">Sign In</a></li>';
        }
        else if ($_SESSION['user']['valid'] == 'true') {
            print '<li><a href="index.php?menu=5">My Recipes</a></li>';
            if($_SESSION['user']['role'] == 1) {
                print '<li><a href="index.php?menu=6">Admin</a></li>';
            }
            print '<li class="new-recipe"><a href="index.php?menu=7">+  New Recipe</a></li>';
            print '<li><a href="sites/signout.php">Sign Out</a></li>';
        }
    ?>
</ul>