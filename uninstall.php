<?php
// Load plugin file.
require_once 'index.php';

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function drop_table_uninstall()
{
    global $wpdb;
    $table1 = $wpdb->prefix . 'contact_form'; // Nama tabel pertama
    $table2 = $wpdb->prefix . 'setting_form'; // Nama tabel kedua
    $table3 = $wpdb->prefix . 'custom_form'; // Nama tabel ketiga

    // Hapus tabel pertama dari database
    $wpdb->query("DROP TABLE IF EXISTS $table1");

    // Hapus tabel kedua dari database
    $wpdb->query("DROP TABLE IF EXISTS $table2");

    // Hapus tabel ketiga dari database
    $wpdb->query("DROP TABLE IF EXISTS $table3");
}

// Uninstall
register_uninstall_hook(__FILE__, "drop_table_uninstall");
