<?php

namespace App\Layouts;

class Footer implements Layout
{
    public static function render()
    {
        // Return the correct HTML structure for the footer with Bootstrap JS CDN
        echo '
        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous">
        </script>
        </body>
        </html>';
    }
}
