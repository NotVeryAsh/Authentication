<?php

session_start([
    // 1 day
    "cookie_lifetime" => 86400,
    "name" => "test-session",
    // Disabled since project doesn't support https
//        "cookie_secure" => true
]);