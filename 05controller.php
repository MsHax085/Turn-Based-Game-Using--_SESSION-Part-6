<?php
//05controller.php

namespace controller;

function checkForInput() {
	if (isset($_GET['reset'])) {
		\model\resetSessionData();
	}
    
    if (!\model\playerAlive()) {// Page refresh fix
        return false;
    }

	if (isset($_GET['dir'])) {
	   
		switch ($_GET['dir']) {
			case "up":
                \model\moveHero(0, -1);
                if (!\model\heroOnPassableTerrain()) {
                     \model\moveHero(0, 1);
                    return false;
                }
				return true;

			case "down":
				\model\moveHero(0, 1);
                if (!\model\heroOnPassableTerrain()) {
                    \model\moveHero(0, -1);
                    return false;
                }
				return true;

			case "left":
				\model\moveHero(-1, 0);
                if (!\model\heroOnPassableTerrain()) {
                    \model\moveHero(1, 0);
                    return false;
                }
				return true;

			case "right":
				\model\moveHero(1, 0);
                if (!\model\heroOnPassableTerrain()) {
                    \model\moveHero(-1, 0);
                    return false;
                }
				return true;
            default:
                return false;
		}
	}
}

?>