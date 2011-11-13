<?php

require_once("objects/main.php");
session_destroy();
header("Location: ".BASE_URL);