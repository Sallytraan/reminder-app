<?php
require_once "../INCLUDES/header.php";
?>

    <form method="POST" action="create-task.php">
        <?php 
            // Skriva felmeddelande angånde task-skrivandet här!!  
        ?>
        <input type="text" name="email" placeholder="What do you need to be reminded of?">
        <div>
            <div id="taskText">
                <p>What is the level of importance?</p>
            </div>
            <div id="importanceCircles">
                <div class="circle"> Red </div>
                <div class="circle"> Yellow </div>
                <div class="circle"> Green </div>
            </div>
        </div>
        <button id="undo-button">
        <a href="../index.php"><img src="../ICONS_BLACK/remove-icon.svg"></a>
        </button>
        <button id="add-button">
            <img src="../ICONS_BLACK/check-icon.svg">
        </button>

    </form>
</main>