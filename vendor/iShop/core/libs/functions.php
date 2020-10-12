<?php

function debug($data, string $title = ''): void
{
    echo '<div style="padding: 10px; border: 3px solid tomato;">';
    if (!empty($title)) {
        echo "<h1 style=\"margin: 0; line-height: 1;\"><mark>{$title}</mark></h1><br>";
    }
    echo '<pre style="margin: 0">' . print_r($data, true) . '</pre>';
    echo '</div>';
}