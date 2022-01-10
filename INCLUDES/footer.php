    </main>
        <footer>
            <?php 

            if (isset($_SESSION["id"])) {

                            echo "
                            <nav>
                                <div id='navList' class='navListBlack'></div>

                                <div id='navFocus' class='navFocusBlack'></div>

                                <div id='navProfile' class='navProfileBlack'></div>
                            </nav>
                            ";                    
     
            }

            ?>
        </footer>
        <?php
        // variabler
        $data = json_decode(file_get_contents("API/users.json"), true);
        $sessionID = $_SESSION["id"];

        // kollar om användaren har skrivit på ett kontrakt eller inte.
        if (!isset($sessionID)){
            echo '<script src="PAGES/welcome.js"></script>';
            //SIGNED
        } else  { // annars skickas till to-do sidan
                        echo '<script src="../PAGES/to-do.js"></script>'; 
                    }

        
        ?>
    <script src="globalVariables.js"></script>
    <script src="commonsElements.js"></script>


    <script src="PAGES/welcomeText.js"></script>
    <script src="PAGES/app-info.js"></script>
  

    <script src="PAGES/focus.js"></script>
    <script src="PAGES/profile.js"></script>
    <script src="PAGES/welcomeSignUp.js"></script>
    <script src="PAGES/profileUpdate.js"></script>
</body>
</html> 