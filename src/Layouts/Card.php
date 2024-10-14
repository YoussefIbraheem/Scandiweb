<?php
namespace App\Layouts;
use App\Layouts\Layout;

class Card implements Layout
{
    public static function render(...$args)
    {
      $id = $args[0];
      $title = $args[1];
      $body = $args[2];

        echo "<div class='card' style='width: 18rem;'>
                <div class='card-body'>
                  <h5 class='card-title'>{$title}</h5>
                  <p class='card-text'>{$body}</p>
                  <a href='#' class='btn btn-primary'>Go somewhere</a>
                </div>
              </div>";
    }
}