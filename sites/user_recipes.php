<h1>Your Recipes</h1>
<div class="row recipeRow">
    <?php
        if($_POST['_action_'] == TRUE) {
            if(isset($_POST['edit'])) {
                header("Location: ./index.php?menu=7&recipe=" . $_POST['id']);
            } else {
                $query2 = "DELETE FROM recipes WHERE id=" . $_POST['id'];
                $result2 = @mysqli_query($con, $query2);
                $src = "./images/" . $_POST['id'];
                $dir = opendir($src);
                while(false !== ( $file = readdir($dir)) ) {
                    if (( $file != '.' ) && ( $file != '..' )) {
                        $full = $src . '/' . $file;
                        if ( is_dir($full) ) {
                            rrmdir($full);
                        }
                        else {
                            unlink($full);
                        }
                    }
                }
                closedir($dir);
                rmdir($src);
            }
        }

        $query = "SELECT id, title FROM recipes WHERE author_id=" . $_SESSION['user']['id'];
        $result = @mysqli_query($con, $query);
        while($row = @mysqli_fetch_array($result)) {
            $images = scandir("./images/" . $row['id']);
        
            echo '<div class="col-4 height100">
                    <div class="item">
                        <a href="./index.php?menu=8&recipe=' . $row['id'] . '">
                            <img src="./images/' . $row['id'] . '/' . $images[2] .'">
                            <h3>' . $row['title'] . '</h3>
                        </a>
                        <form method="post" name="delete_edit_form" id="delete_edit_form">
                            <input type="hidden" id="_action_" name="_action_" value="TRUE">   
                            <input type="hidden" id="id" name="id" value="'. $row['id'] .'">  
                            
                            <input type="submit" name="edit" id="edit_button" class="edit_button" value="Edit">
                            <input type="submit" name="delete" id="delete_button" class="delete_button" value="Delete">
                        </form>
                    </div>
                </div>';
        }
    ?>
</div>