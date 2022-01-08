    </main>
        <footer>
            <?php 

            if (isset($_SESSION["id"])) {
                $id = $_SESSION["id"];

                foreach ($data as $key => $value) {
                    if ($id == $value["id"]) {
                        // göra if-sats för bara inloggning har tillgång till anv.
                        if ($value["contract"]) {
                            echo "
                            <nav>
                                <div id='navList' class='navListBlack'></div>

                                <div id='navFocus' class='navFocusBlack'></div>

                                <div id='navProfile' class='navProfileBlack'></div>
                            </nav>
                            ";                    
                        }                          
                    }
                }  
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
        } else {
            foreach ($data as $key => $value) {
                // echo $value["id"];
                // echo $_SESSION["id"];
                if ($sessionID == $value["id"]) {
                    // om kontrakt ej påskrivet --> visa kontraktet
                    if (!$value["contract"]){
                        echo '<script src="../PAGES/contract.js"></script>';

                    } 
                    else { // annars skickas till to-do sidan
                        echo '<script src="../PAGES/to-do.js"></script>'; 
                    }
                }
            }
        }
        ?>
    <script src="globalVariables.js"></script>
    <script src="commonsElements.js"></script>


    <script src="PAGES/welcomeText.js"></script>
    <script src="PAGES/app-info.js"></script>
  

    <script src="PAGES/focus.js"></script>
    <script src="PAGES/profile.js"></script>
</body>
</html> 