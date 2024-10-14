<?php 
namespace App\Layouts;

class Navbar implements Component
{
    public static function render(...$args)
    {
        // The argument is an array of menu items where each item has 'label' and 'link'
        $menuItems = $args ?? 'Not Found' ;

    
        $menu = '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Scandiweb Product List</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">';

        foreach ($menuItems as $item) {
            $link = array_values($item)[0];
            $label = array_keys($item)[0];         
            $menu .= "<li class='nav-item'>
                          <a class='nav-link' href='{$link}'>{$label}</a>
                      </li>";
        }

        $menu .= '</ul>
                  </div>
                  </div>
                  </nav>';

        echo $menu;
    }
}

?>