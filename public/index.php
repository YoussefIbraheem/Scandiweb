<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Layouts\Card;
use App\Layouts\Footer;
use App\Layouts\Header;
use App\Layouts\Navbar;

(new Header('Scandiweb product List'))->render();

(new Navbar(['About'=>'https://google.com']))->render();

for($i = 0 ; $i <= 5 ;$i++)
{
(New Card($i,"title{$i}","body{$i}"))->render();
}

(new Footer)->render();