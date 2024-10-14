<?php
 require_once __DIR__ . '../../vendor/autoload.php';

use App\Layouts\Card;
use App\Layouts\Footer;
use App\Layouts\Header;
use App\Layouts\Navbar;

Header::render();
Navbar::render(['About'=>"https://google.com"],['Contact'=>"https://youtube.com"]);
Card::render();
Footer::render();
?>