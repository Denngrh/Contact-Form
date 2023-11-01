<?php
function menuku()
{
    add_menu_page('Contact-Form', 'Contact Form', '', 'menu', 'use_menu', 'dashicons-email', '20');
    add_submenu_page('menu', 'Sub Menu', 'Dashboard', 'manage_options', 'Dashbord', 'Dashbord');
    add_submenu_page('menu', 'Sub Menu', 'Hasil Terkirim', 'manage_options', 'Contact', 'result');
    add_submenu_page('menu', 'Sub Menu', 'Custom Form', 'manage_options', 'Style-form', 'StyleForm');
    add_submenu_page('menu', 'Sub Menu', 'SMTP Setting', 'manage_options', 'Smtp-setting', 'smtp_setting');
    add_submenu_page('menu', 'Sub Menu', 'Example Form', 'manage_options', 'Example-form', 'example');
}

function dashbord()
{
    include('views/dashbord.php');
}
function smtp_setting()
{
    include('views/setting.php');
}
function result()
{
    include('views/contact.php');
}
function StyleForm()
{
    include('views/custom.php');
}
function is_smt_setting_completed()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'setting_form';
    $smt_setting = $wpdb->get_row("SELECT * FROM $table_name");

    if ($smt_setting) {
        return !empty($smt_setting->username) && !empty($smt_setting->password) && !empty($smt_setting->host) && !empty($smt_setting->port) && !empty($smt_setting->set_for);
    } else {
        return false;
    }
}

function example()
{
    if (!is_smt_setting_completed()) {
?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script src="https://kit.fontawesome.com/6acd0a1998.js" crossorigin="anonymous"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Setting SMTP Dulu!!',
                    iconHtml: '<i class="fa-solid fa-exclamation" style="color: ##F27474;"></i>',
                }).then(function() {
                    window.location = "<?php echo admin_url('admin.php?page=Smtp-setting'); ?>";
                });
            });
        </script>
<?php
    } else {
        include('views/for_shortcode.php');
    }
}

//INSERT DATA 
//insert send mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function insert_data_callback()
{
    error_reporting(0);

    include(plugin_dir_path(__FILE__) . 'PHPMailer/src/Exception.php');
    include(plugin_dir_path(__FILE__) . 'PHPMailer/src/PHPMailer.php');
    include(plugin_dir_path(__FILE__) . 'PHPMailer/src/SMTP.php');
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';

    // Ambil data yang dikirimkan melalui form
    $first = sanitize_text_field($_POST['first']);
    $address = sanitize_text_field($_POST['address']);
    $number = sanitize_text_field($_POST['number']);
    $email = sanitize_text_field($_POST['email']);
    $pesan = sanitize_text_field($_POST['text']);

     // Validasi apakah pesan kosong
     if (empty($pesan)) {
        echo "
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Isi semua form',
                }).then(function() {
                    window.history.back();
                });
            });
        </script>";
        return; // Hentikan eksekusi jika pesan kosong
    }

    // Query untuk insert data
    $data = array(
        'name' => $first,
        'address' => $address,
        'phone' => $number,
        'email' => $email,
        'message' => $pesan,
    );

    //ngambill table beda
    $kirim_table = $wpdb->prefix . 'setting_form';
    $query = "SELECT * FROM $kirim_table";
    $results = $wpdb->get_results($query);

    // Buat proses untuk menentukan apakah pengiriman email berhasil atau tidak
    $email_sent = false;

    if ($results) {
        foreach ($results as $result) {
            $to = $result->set_for;
            $smtp_host = $result->host;
            $smtp_port = $result->port;
            $smtp_username = $result->username;
            $smtp_password = $result->password;

            $mail = new PHPMailer();
            $mail->isSMTP(true);
            $mail->isHTML(true);
            $mail->Host = $smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $smtp_username;
            $mail->Password = $smtp_password;
            $mail->Port = $smtp_port;
            $mail->setFrom($smtp_username, 'Contact Form');
            $mail->addAddress($to);
            $mail->Subject = 'Pernyataan pengguna';
            $body = '<html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                    }
                    .header {
                        text-align: center;
                    }
                    .logo {
                        max-width: 150px;
                    }
                    .message {
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <img src="https://github.com/Denngrh/Smt-Contact-Form/assets/112230212/43c74a3f-94e5-4973-8487-0c5e68526042" alt="Logo" class="logo">
                        <h2 style="margin-top: 10px;">Terima kasih untuk pesan Anda</h2>
                    </div>
                    <div class="message">
                        <p style="color: #333;">Hi ' . $first . ',</p>
                        <p style="color: #333;">Terima kasih untuk pesan Anda. Berikut detail yang Anda berikan:</p>
                        <ul>
                            <li><strong>Name:</strong> ' . $first . '</li>
                            <li><strong>Address:</strong> ' . $address . '</li>
                            <li><strong>Phone Number:</strong> ' . $number . '</li>
                            <li><strong>Email:</strong> ' . $email . '</li>
                            <li><strong>Message:</strong> ' . $pesan . '</li>
                        </ul>
                        <p style="color: #333;">Terima kasih telah mengirimkan pesannya.</p>
                    </div>
                </div>
            </body>
            </html>';

            $mail->Body = $body;
            if ($mail->send()) {
                // Pengiriman email berhasil
                $email_sent = true;
            } else {
                echo " 
                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '" . addslashes($mail->ErrorInfo) . "', 
                        }).then(function() {
                            window.history.back();
                        });
                    });
                </script>";
            }
        }
    }
    if ($email_sent) {
        $wpdb->query('START TRANSACTION');
        $wpdb->insert($table_name, $data);
        if ($wpdb->last_error) {
            echo 'Terjadi kesalahan saat menyimpan data ke database: ' . $wpdb->last_error;
            $wpdb->query('ROLLBACK');
        } else {
            $wpdb->query('COMMIT');
            echo " 
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!!',
                        text: 'Telah berhasil kirim',
                        timer: 2000,
                    }).then(function() {
                        window.history.back();
                    });
                });
            </script>";
        }
    }
}


// Delete data
function delete_data_callback()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $id = $_GET['id'];
    // Hapus data berdasarkan ID
    $result = $wpdb->delete($table_name, array('id' => $id));
    if ($result) {
        wp_redirect(admin_url('admin.php?page=Contact'));
        exit;
    } else {
        echo 'Terjadi kesalahan saat menghapus data.';
    }
    wp_die();
}

// Update setting
function update_setting_callback()
{
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama =  $_POST['username'];
        $pass = $_POST['pass'];
        $host = $_POST['host'];
        $port = $_POST['port'];
        $set_for = $_POST['for'];

        global $wpdb;
        $table_name = $wpdb->prefix . 'setting_form';

        $data = array(
            'username' => $nama,
            'password' => $pass,
            'host' => $host,
            'port' => $port,
            'set_for' => $set_for
        );
        $where = array(
            'id_setting' => $id
        );
    }
    $result = $wpdb->update($table_name, $data, $where);
    var_dump($result);

    if ($result) {
        wp_redirect(admin_url('admin.php?page=Smtp-setting'));
        exit;
    } else {
        echo 'error';
    }
    wp_die();
}

// Update data
function ambil_data_callback()
{
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $title = $_POST['slider_name'];
        $title_size = $_POST['title_size'];
        $title_font = $_POST['title_fam'];
        $title_color = $_POST['title_color'];
        $pdg = $_POST['padding'] . 'px';
        $font_fam = $_POST['font_fam'];
        $ft = $_POST['ft_color'];
        $border = $_POST['border_option'];
        $btn_clr = $_POST['button_color'];
        $ft_clr = $_POST['font_color'];
        $btn_clr_hover = $_POST['button_color_hover'];
        $ft_clr_hover = $_POST['font_color_hover'];
        $text_alignment = $_POST['text_alignment'];
        $button_alignment = $_POST['button_alignment'];

        global $wpdb;
        $existing_css = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}custom_form WHERE id_style = $id", ARRAY_A);

        // Jika data CSS sudah ada dalam database
        if ($existing_css) {
            // Ambil data JSON dari database
            $json_data = json_decode($existing_css['style_form'], true);

            // Perbarui data JSON sesuai dengan input yang diterima
            $json_data['title'] = $title;
            $json_data['title_size'] = $title_size;
            $json_data['title_fam'] = $title_font;
            $json_data['title_color'] = $title_color;
            $json_data['padding'] = $pdg;
            $json_data['font_fam'] = $font_fam;
            $json_data['ft_color'] = $ft;
            $json_data['border'] = $border;
            $json_data['button_color'] = $btn_clr;
            $json_data['font_color'] = $ft_clr;
            $json_data['buttton_color_hover'] = $btn_clr_hover;
            $json_data['font_color_hover'] = $ft_clr_hover;
            $json_data['text_alignment'] = $text_alignment;
            $json_data['button_alignment'] = $button_alignment;

            if (isset($_POST['check_first']) && $_POST['check_first'] === 'on') {
                update_option('check_first_option', true);
            } else {
                update_option('check_first_option', false);
            }
           
            if (isset($_POST['check_address']) && $_POST['check_address'] === 'on') {
                update_option('check_address_option', true);
            } else {
                update_option('check_address_option', false);
            }

            if (isset($_POST['check_number']) && $_POST['check_number'] === 'on') {
                update_option('check_number_option', true);
            } else {
                update_option('check_number_option', false);
            }

            if (isset($_POST['check_email']) && $_POST['check_email'] === 'on') {
                update_option('check_email_option', true);
            } else {
                update_option('check_email_option', false);
            }

            $updated_json_data = json_encode($json_data);

            // Perbarui data di dalam database
            $result = $wpdb->update(
                $wpdb->prefix . 'custom_form',
                array('style_form' => $updated_json_data),
                array('id_style' => $id)
            );

            if ($result !== false) {
                wp_redirect(admin_url('admin.php?page=Style-form'));
                exit;
            } else {
                echo 'Terjadi kesalahan saat melakukan update data.';
            }
        }
    }
}
//Save Setting
function save_settings()
{
    if (isset($_POST['check_first']) && $_POST['check_first'] === 'on') {
        update_option('check_first_option', true);
    } else {
        update_option('check_first_option', false);
    }
   
    if (isset($_POST['check_address']) && $_POST['check_address'] === 'on') {
        update_option('check_address_option', true);
    } else {
        update_option('check_address_option', false);
    }
   
    if (isset($_POST['check_number']) && $_POST['check_number'] === 'on') {
        update_option('check_number_option', true);
    } else {
        update_option('check_number_option', false);
    }

    if (isset($_POST['check_email']) && $_POST['check_email'] === 'on') {
        update_option('check_email_option', true);
    } else {

        update_option('check_email_option', false);
    }

    wp_redirect(admin_url('admin.php?page=example'));
    exit;
    wp_die();
}


function display_page_template($template)
{
    if (is_page('example')) {
        $new_template = locate_template(array('views/example.php'));
        if ('' != $new_template) {
            return $new_template;
        }
    }
    return $template;
}

add_action('admin_post_save_settings', 'save_settings');
add_filter('template_include', 'display_page_template');

//AMBIL DATA
add_action('admin_post_ambil_data', 'ambil_data_callback');

//action update setting
add_action('admin_post_update_setting', 'update_setting_callback');

// action delete
add_action('admin_post_delete_data', 'delete_data_callback');

//action insert
add_action('admin_post_insert_data', 'insert_data_callback');
add_action('admin_post_nopriv_insert_data', 'insert_data_callback');

// ADD MENU
add_action('admin_menu', 'menuku');
