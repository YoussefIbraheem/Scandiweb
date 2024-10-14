<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Scandiweb Product List</a>
        <div class="d-flex ms-auto">
            <ul class="navbar-nav">
                <?php

                foreach ($data as $label => $link) {

                    echo "<li class='nav-item'>
      <a class='nav-link' href='{$link}'>{$label}</a>
  </li>";
                }
                echo "</ul>
</div>
</div>
</nav>";
                ?>