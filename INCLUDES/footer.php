        <?php
        $data = json_decode(file_get_contents("API/users.json"), true);
        
        if (!isset($_SESSION["id"])){
            echo '<script src="PAGES/welcome.js"></script>';
            //SIGNED
        } else {
            foreach ($data as $key => $value) {
                // echo $value["id"];
                // echo $_SESSION["id"];
                
                if (!$value["contract"]){
                    echo '<script src="../PAGES/contract.js"></script>';
                } else {
                    echo '<script src="../PAGES/to-do.js"></script>'; 
                }

                // if ($_SESSION["id"]){}
            }
            // echo '<script src="PAGES/to-do.js"></script>';
        }
        ?>
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
                                <div id='navList'>
                                    <img src='../ICONS_BLACK/list-icon.svg' alt='list'>
                                </div>
                                <div id='navFocus'>
                                    <img src='../ICONS_BLACK/timer-icon.svg' alt='timer'>
                                </div>
                                <div id='navProfile'>
                                    <img src='../ICONS_BLACK/profile-icon.svg' alt='profile'>
                                </div>
                            </nav>
                            ";                    
                        }                          
                    }
                }  
            }

            ?>
        </footer>
    
    <script src="globalVariables.js"></script>
    <script src="commonsElements.js"></script>



    <script src="PAGES/welcomeText.js"></script>
    <script src="PAGES/app-info.js"></script>

    <script src="PAGES/focus.js"></script>
    <script src="PAGES/profile.js"></script>
</body>
</html> 