<?php
// app/helpers/url_helper.php

// Función para redirigir a otra página
function redirect($page){
    header('location: ' . URLROOT . '/' . $page);
    exit();
}
