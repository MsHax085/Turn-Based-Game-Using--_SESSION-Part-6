<?php
//05view.php

namespace view;

function outputEvent($eventText) {
    echo "<br /><br /><b>$eventText</b>";
}

function outputGameWorld() {
	for ($y = 0; $y < HEIGHT; $y++) {
		for ($x = 0; $x < WIDTH; $x++) {
			$map = \model\map($y, $x);
            if ($map == " ") {
            	echo "<div class=G>";
            } else {
            	echo "<div class=$map>";
            }
            
            if ($x == \model\heroX() && $y == \model\heroY()) {
			    if (\model\playerAlive()) {
				   echo "<div class=H></div>";
                } else {
				   echo "<div class=H></div>";
                }
            }
            echo "</div>";
		}
	}
}

// Dead msg
function outputObituary() {
    echo "<br /><br /><b>It seems like ... you died!</b>";
}

function outputStats() {
    echo "HP: " . \model\heroHp();
    echo "<br />";
    echo "XP: " . \model\heroXp();
}

function outputStyle() {
	echo "<style>
	body {
	   width: 672px;
	   font-family: courier;
	   font-size: 32px;
       margin: 0px auto;
       text-align: center;
	}
	.H {
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('tiles/character.png');
	}
	.G {
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('tiles/grass.png');
	}
	.F {
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('tiles/trees_1.png');
	}
	.W {
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('tiles/big_lake_1.png');
	}
	.M {
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('tiles/mountain_1.png');
	}
	</style>";
}

function outputTitle() {
	echo "<h2>Turn Based Game<br/>Using \$_SESSION<br/><small>Part 06: Alternate Views</small></h2>";
}

function outputUserInterface() {
	echo "<p>";
        if (\model\playerAlive()) {
        	echo "<a href='?dir=up'>up</a> ";
        	echo "<a href='?dir=down'>down</a> ";
        	echo "<a href='?dir=left'>left</a> ";
        	echo "<a href='?dir=right'>right</a> ";
        }
    	echo "<a href='?reset'>reset</a>";
	echo "</p>";
}

function outputView($eventText) {
    outputStyle();
    outputTitle();
    outputGameWorld();
    outputUserInterface();
    outputStats();
    
    if(isset($eventText)) {
    	outputEvent($eventText);
    }
    if (!\model\playerAlive()) {
   	    outputObituary();
    }
}

?>