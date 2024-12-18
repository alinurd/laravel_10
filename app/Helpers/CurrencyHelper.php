<?php

if (!function_exists('format_rupiah')) {
 
    function format_rupiah($amount)
    { 
    $amount = preg_replace('/[^0-9-]/', '', $amount);
            return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
