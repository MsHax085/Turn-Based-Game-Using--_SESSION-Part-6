<?php
//05model.php

namespace model;

function startup() {
	session_start();
	init();
}

function init() {
	if (!isset($_SESSION['herox']) || !isset($_SESSION['heroy']) || !isset($_SESSION['herohp']) || !isset($_SESSION['heroxp']) || !isset($_SESSION['map'])) {
		resetSessionData();
	}
}

function resetSessionData() {
    $_SESSION['herox'] = START_X;
	$_SESSION['heroy'] = START_Y;
	$_SESSION['herohp'] = MAX_HP;
	$_SESSION['heroxp'] = 0;
    
    $_SESSION['map'][0] = topBottomMapRow();

    for ($y = 1; $y < HEIGHT - 1; $y++) {
    	$_SESSION['map'][$y] = randomMapRow();
    }
    
    $_SESSION['map'][HEIGHT - 1] = topBottomMapRow();
    
    if (!heroOnPassableTerrain()) {
        $_SESSION['map'][START_Y][START_X] = " ";
    }
}

function moveHero($deltaX, $deltaY) {
    $_SESSION['herox'] += $deltaX;
	$_SESSION['heroy'] += $deltaY;
}

function heroX() {
    return $_SESSION['herox'];
}

function heroY() {
    return $_SESSION['heroy'];
}

function map($y, $x) {
    return $_SESSION['map'][$y][$x];
}

function heroHp() {
    return $_SESSION['herohp'];
}

function heroXp() {
    return $_SESSION['heroxp'];
}

function playerAlive() {
    return heroHp() > 0;
}

function heroOnPassableTerrain() {
    $block = map(heroY(), heroX());
    return $block != "M" && $block != "W";
}

function changeHP($value) {
    if (heroHp() + $value > MAX_HP) {
        $_SESSION['herohp'] = MAX_HP;
    } else {
        $_SESSION['herohp'] += $value;
    }
}

function changeXP($value) {
    $_SESSION['heroxp'] += $value;
}

function doEvent() {
    $randomIndex = rand(1, 3);// improved :)
    
    switch($randomIndex) {
        default:
                return null;
                break;
                
        case 1:
                changeHP(-10);
                changeXP(100);
                return "You fight an evil wizard and defeat him! HP -10 XP +100";
                break;
    }
}

function randomMapRow() {
    $grass_chance = 5;
    $forest_chance = 8;
    $water_chance = 9;
    $mountain_chance = 10;
    $returnString = "";
    
    for ($x = 0; $x < WIDTH; $x++) {
        $randomChance = rand(1, 10);
        
        if ($x == 0 || $x == WIDTH - 1) {
            $returnString .= "M";
        } else if ($randomChance <= $grass_chance) {
            $returnString .= " ";
        } else if ($randomChance <= $forest_chance) {
            $returnString .= "F";
        } else if ($randomChance <= $water_chance) {
            $returnString .= "W";
        } else if ($randomChance <= $mountain_chance) {
            $returnString .= "M";
        }
    }
    return $returnString;
}

function topBottomMapRow() {
    $returnString = "";
    for ($column = 0; $column < WIDTH; $column++) {
        $returnString .= "M";
    }
    
    return $returnString;
}

?>