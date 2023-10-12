<?php
/*
* Plugin Name: SMT - Contact - Form
* Plugin URI: http://www.orangecreative.net 
* Description: Plugin Contact Form adalah plugin untuk membuat dan mengelola formulir kontak yang dapat  disesuaikan di situs web WordPress Anda. Pengguna dapat dengan mudah mengatur tampilan formulir,mengaktifkan pengiriman email melalui protokol SMTP, dan mengintegrasikan formulir dengan akun Gmail mereka. 
* Author: Baden Nugraha
* Version: 1.0.0
* Author URI: https://github.com/Denngrh
* License: GPL-2.0+
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

require_once(dirname(__FILE__) . '/hook.php');

require_once(dirname(__FILE__) . '/shortcode.php');

//create table Contact-Form
function create_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "contact_form";
    $sql = "CREATE TABLE $table_name (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        name varchar(50) DEFAULT NULL,
        address varchar(80) DEFAULT NULL,
        phone varchar(50) DEFAULT NULL,
        email varchar(150) DEFAULT NULL,
        message TEXT (150) DEFAULT NULL,
        PRIMARY KEY (`id`)
)";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

//create table setting
function create_setting()
{
    global $wpdb;
    $setting_table = $wpdb->prefix . "setting_form";
    // Mengecek apakah tabel sudah ada
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$setting_table'") === $setting_table;
    if (!$table_exists) {
        $sql = "CREATE TABLE $setting_table (
            id_setting bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            username varchar(50) NOT NULL,
            password varchar(50) NOT NULL,
            host varchar(80) NOT NULL,
            port varchar(50) NOT NULL,
            set_for varchar(150) NOT NULL,
            PRIMARY KEY (`id_setting`)
        )";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        $wpdb->insert(
            $setting_table,
            array(
                'username' => 'Example@gmail.com',
            )
        );
    }
}

// CREATE Custom
function create_table_custom_form()
{
    global $wpdb;

    $custom_table = $wpdb->prefix . 'custom_form';
    $custom_exist = $wpdb->get_var("SHOW TABLES LIKE '$custom_table'") === $custom_table;
    if (!$custom_exist) {
        $sql = "CREATE TABLE $custom_table (
        id_style bigint(80) unsigned NOT NULL AUTO_INCREMENT,
        nama VARCHAR(80) DEFAULT NULL,
        padding VARCHAR(80) DEFAULT NULL,
        font_family VARCHAR(80) DEFAULT NULL,
        ft_color VARCHAR(80) DEFAULT NULL,
        button_color VARCHAR(80) DEFAULT NULL,
        font_color VARCHAR(80) DEFAULT NULL,
        buttton_color_hover VARCHAR(80) DEFAULT NULL,
        font_color_hover VARCHAR(80) DEFAULT NULL,
        PRIMARY KEY (`id_style`)
    )";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $wpdb->insert(
            $custom_table,
            array(
                'nama' => 'form_first',
            )
        );
    }
}

//Delete Custom
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


//custom_tabel
register_activation_hook(__FILE__, 'create_table_custom_form');
//setting tabel
register_activation_hook(__FILE__, "create_setting");
//action tabel
register_activation_hook(__FILE__, "create_table");
// Uninstall
register_uninstall_hook(__FILE__, "drop_table_uninstall");
