<?php

echo "
<div class='col-md-3 mb-4'>
    <div class='card' style='position:relative; width: 100%;'>
        <input type='checkbox' class='form-check-input' style='position: absolute; top: 10px; left: 10px;' id='checkbox_{$data['id']}'>
        <div class='card-body'>
            <h5 class='card-title'>{$data['title']}</h5>
            <p class='card-text'>{$data['body']}</p>
            <a href='#' class='btn btn-primary'>{$data['id']}</a>
        </div>
    </div>
</div>";
?>
