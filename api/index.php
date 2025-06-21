<?php

if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
}

require __DIR__ . "/../public/index.php";
