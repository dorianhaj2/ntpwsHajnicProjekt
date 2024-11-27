<h1>Featured Recipes</h1>
<div class="row recipeRow">
    <?php
        $query = "SELECT id, title, author_id FROM recipes LIMIT 3";
        $result = @mysqli_query($con, $query);
        while($row = @mysqli_fetch_array($result)) {
            $images = scandir("./images/" . $row['id']);
            $query2 = "SELECT username FROM users WHERE id=" . $row['author_id'];
            $result2 = @mysqli_query($con, $query2);
            $row2 = @mysqli_fetch_array($result2);

            echo '<div class="col-4 height100">
                    <div class="item">
                        <a href="./index.php?menu=8&recipe=' . $row['id'] . '">
                            <img src="./images/' . $row['id'] . '/' . $images[2] .'">
                            <h3>' . $row['title'] . '</h3>
                            <p>Author: ' . $row2['username'] . '</p>
                        </a>
                    </div>
                </div>';
        }
    ?>
</div>

<h1>New Recipes</h1>
<div class="row recipeRow">
    <?php
        $query = "SELECT id, title, author_id FROM recipes ORDER BY id DESC LIMIT 3";
        $result = @mysqli_query($con, $query);
        while($row = @mysqli_fetch_array($result)) {
            $images = scandir("./images/" . $row['id']);
            $query2 = "SELECT username FROM users WHERE id=" . $row['author_id'];
            $result2 = @mysqli_query($con, $query2);
            $row2 = @mysqli_fetch_array($result2);

            echo '<div class="col-4 height100">
                    <div class="item">
                        <a href="./index.php?menu=8&recipe=' . $row['id'] . '">
                            <img src="./images/' . $row['id'] . '/' . $images[2] .'">
                            <h3>' . $row['title'] . '</h3>
                            <p>Author: ' . $row2['username'] . '</p>
                        </a>
                    </div>
                </div>';
        }
    ?>
</div>