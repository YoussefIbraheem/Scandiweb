<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Scandiweb Product List</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
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