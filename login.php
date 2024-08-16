<?php

include('session.php');

require_once("Authentication.php");

(new Authentication())->login();