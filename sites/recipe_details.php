<?php
    $query = "SELECT * FROM recipes WHERE id=" . $_GET['recipe'];
    $result = @mysqli_query($con, $query);
    $row = @mysqli_fetch_array($result);

    print "<h1>" . $row['title'] ."</h1>";
?>

<div class="w3-content w3-display-container slider">
    <?php
        $images = scandir("./images/" . $row['id']);
        for($i = 2; $i < count($images); $i++) {    
            print '<img class="mySlides" src="./images/' . $row['id'] . '/' . $images[$i] . '" style="width:100%">';
        }
    ?>

    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<div class="description">
    <?php
        $desc = nl2br($row['description']);
        print "<p>" . $desc . "</p>"; 
     ?>
       
</div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    x[slideIndex-1].style.display = "block";  
    }
</script>