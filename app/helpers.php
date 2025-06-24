<?php

if (!function_exists('theme_color')) {
    function theme_color($key = 'primary_color') {
        return config("theme.$key");
    }
}
