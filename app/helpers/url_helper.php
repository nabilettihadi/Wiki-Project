<?php
// Simple page redirect
function redirect($page)
{
    $url = URLROOT . '/' . $page;
    header('Location: ' . filter_var($url, FILTER_SANITIZE_URL));
    exit();
}