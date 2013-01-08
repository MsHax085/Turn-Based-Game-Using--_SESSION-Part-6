<?php

require_once("05constants.php");
require_once("05model.php");
require_once("05controller.php");
require_once("05view.php");

//entry point
\model\startup();
if (\controller\checkForInput()) {
	$eventText = \model\doEvent();
}
\view\outputView(isset($eventText) ? $eventText : "");

?>