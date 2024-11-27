<?php 
	print '
	<div class="row">
	<div class="offset-3 col-6">';
	
	if ($_POST['_action_'] == FALSE) {
        if(!isset($_GET['recipe'])) {
            print '
            <h1>New Recipe</h1>
	        <div id="add_recipe">
            <form enctype="multipart/form-data" action="" id="reg_signin_addrec_form" name="add_recipe_form" method="POST">
                <input type="hidden" id="_action_" name="_action_" value="TRUE">
                <input type="hidden" id="_edit_" name="_edit_" value="FALSE">
    
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br>
                
                <label for="description">Description: </label><br>
                <textarea name="description" id="description" rows="10" columns="50"></textarea><br>
                
                <input type="file" id="images" name="images[]" accept="image/*" multiple>
    
                <input type="submit" class="submit" value="Create Recipe">
            </form>'; 
        } else {

            $query = "SELECT * FROM recipes WHERE id=" . $_GET['recipe'];
            $result = @mysqli_query($con, $query);
            $row = @mysqli_fetch_array($result);

            print '
            <h1>Edit Recipe</h1>
	        <div id="add_recipe">
            <form enctype="multipart/form-data" action="" id="reg_signin_addrec_form" name="add_recipe_form" method="POST">
                <input type="hidden" id="_action_" name="_action_" value="TRUE">
                <input type="hidden" id="edit" name="edit" value="TRUE">
                <input type="hidden" id="id" name="id" value="' . $row['id'] . '">
    
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="' . $row['title'] . '" required><br>
                
                <label for="description">Description: </label><br>
                <textarea name="description" id="description" rows="10" columns="50">' . $row['description'] . '</textarea><br>
                
                <input type="file" id="images" name="images[]" accept="image/*" multiple>
    
                <input type="submit" class="submit" value="Confirm">
            </form>';
        }
	}
	else if ($_POST['_action_'] == TRUE) {
        if($_POST['_edit_'] == "FALSE") {
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $query  = "INSERT INTO recipes (title, description, author_id)";
            $query .= " VALUES ('" . $_POST['title'] . "', '" . $description . "', " . $_SESSION['user']['id'] . ")";
            $result = @mysqli_query($con, $query);
            $error = mysqli_error($con);
            if($error == "") {
                $query = "SELECT id FROM recipes ORDER BY id DESC LIMIT 1;";
                $result = @mysqli_query($con, $query);
                $row = @mysqli_fetch_array($result);
                
                mkdir("./images/" . $row['id'] );
        
                if(isset($_FILES['images'])) {
                    $total = count($_FILES['images']['name']);
                    for($i = 0 ; $i < $total ; $i++) {
                        $tmpFilePath = $_FILES['images']['tmp_name'][$i];
        
                        if ($tmpFilePath != ""){
        
                            $newFilePath = "./images/" . $row['id'] ."/" . $_FILES['images']['name'][$i];
        
                            move_uploaded_file($tmpFilePath, $newFilePath); 
                        }
                    }
                }
        
                echo '<p> Recipe created. </p>
                <hr>';
            } else {
                echo $error;
            }
        } else {
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $query  = "UPDATE recipes SET title = '" . $_POST['title'] . "', description = '" . $description ."'";
            $query .= "  WHERE id=" . $_POST['id'];
            $result = @mysqli_query($con, $query);
            $error = mysqli_error($con);

            if($error == "") {
                if(isset($_FILES['images'])) {
                    $total = count($_FILES['images']['name']);
                    for($i = 0 ; $i < $total ; $i++) {
                        $tmpFilePath = $_FILES['images']['tmp_name'][$i];
        
                        if ($tmpFilePath != ""){
        
                            $newFilePath = "./images/" . $_POST['id'] ."/" . $_FILES['images']['name'][$i];
        
                            move_uploaded_file($tmpFilePath, $newFilePath); 
                        }
                    }
                }

                header("Location: ./index.php?menu=8&recipe=" . $_POST['id']);
            } else {
                echo $error;
            }
        }
		
	}
	print '
	</div></div></div>';
?>