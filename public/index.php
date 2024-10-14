<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Layouts\Card;
use App\Layouts\Footer;
use App\Layouts\Header;
use App\Layouts\Navbar;

(new Header('Scandiweb product List'))->render();

(new Navbar(['About'=>'https://google.com']))->render();

echo "<div class='container mt-4'>
        <div class='row'>";

for($i = 0 ; $i <= 5 ; $i++) {
    (new Card($i,"Title {$i}", "Body {$i}"))->render();
}

echo "</div></div>";

(new Footer)->render();