        </main>
        <footer>
            <?php 
            // göra if-sats för bara inloggning har tillgång till anv.
            if (isset($_SESSION["id"])) {}
            ?>
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
        </footer>
    
    <script src="globalVariables.js"></script>
    <script src="commonsElements.js"></script>

    <script src="PAGES/welcome.js"></script>
    <script src="PAGES/app-info.js"></script>
    <script src="PAGES/contract.js"></script>

    <script src="PAGES/to-do.js"></script>
    <script src="PAGES/focus.js"></script>
    <script src="PAGES/profile.js"></script>
</body>
</html> 