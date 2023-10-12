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
        include('views/example.php');
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

    // Buat flag untuk menentukan apakah pengiriman email berhasil atau tidak
    $email_sent = false;

    if ($results) {
        foreach ($results as $result) {
            $to = $result->set_for;
            $smtp_host = $result->host;
            $smtp_port = $result->port;
            $smtp_username = $result->username;
            $smtp_password = $result->password;

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $smtp_username;
            $mail->Password = $smtp_password;
            $mail->Port = $smtp_port;
            $mail->setFrom($smtp_username, 'your form');
            $mail->addAddress($to);
            $mail->Subject = 'Send data';

            $body = '';

            if (!empty($first)) {
                $body .= "First: $first\n";
            }
            if (!empty($address)) {
                $body .= "Address: $address\n";
            }
            if (!empty($number)) {
                $body .= "Number: $number\n";
            }
            if (!empty($email)) {
                $body .= "Email: $email\n";
            }
            if (!empty($pesan)) {
                $body .= "Message: $pesan\n";
            }

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
                            text: '".addslashes($mail->ErrorInfo)."', 
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
        $name = $_POST['nama'];
        $pdg =  $_POST['padding'];
        $font_family = $_POST['font_family'];
        $ft = $_POST['ft_color'];
        $btn_clr = $_POST['button_color'];
        $ft_clr = $_POST['font_color'];
        $btn_clr_hover = $_POST['button_color_hover'];
        $ft_clr_hover = $_POST['font_color_hover'];

        global $wpdb;
        $update_table_custom = $wpdb->prefix . 'custom_form';

        $data = array(
            'padding' => $pdg,
            'font_family' => $font_family,
            'ft_color' => $ft,
            'button_color' => $btn_clr,
            'font_color' => $ft_clr,
            'buttton_color_hover' => $btn_clr_hover,
            'font_color_hover' => $ft_clr_hover,
            'nama' => $name,
        );
        $where = array(
            'id_style' => $id
        );
    }
    $result = $wpdb->update($update_table_custom, $data, $where);
    var_dump($result);

    if (isset($_POST['check_first']) && $_POST['check_first'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_first_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_first_option', false);
    }

    //last
    if (isset($_POST['check_last']) && $_POST['check_last'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_last_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_last_option', false);
    }

    //address
    if (isset($_POST['check_address']) && $_POST['check_address'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_address_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_address_option', false);
    }

    //address
    if (isset($_POST['check_number']) && $_POST['check_number'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_number_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_number_option', false);
    }

    //address
    if (isset($_POST['check_email']) && $_POST['check_email'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_email_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_email_option', false);
    }

    if ($result) {
        wp_redirect(admin_url('admin.php?page=Example-form'));
        exit;
    } else {
        echo 'Terjadi kesalahan saat melakukan update data.';
    }
}
//Save Setting
function save_settings()
{
    if (isset($_POST['check_first']) && $_POST['check_first'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_first_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_first_option', false);
    }

    //address
    if (isset($_POST['check_address']) && $_POST['check_address'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_address_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_address_option', false);
    }

    //address
    if (isset($_POST['check_number']) && $_POST['check_number'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_number_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_number_option', false);
    }

    //address
    if (isset($_POST['check_email']) && $_POST['check_email'] === 'on') {
        // Checkbox tercentang, lakukan sesuatu
        update_option('check_email_option', true);
    } else {
        // Checkbox tidak tercentang, lakukan sesuatu
        update_option('check_email_option', false);
    }

    // Redirect ke halaman lain setelah form disimpan
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
function get_data_callback()
{
    $id = $_POST['id'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';

    $data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");

    if ($data) {
        // Inisialisasi tampilan dengan format yang rapi
        $displayData = '<ul>';

        if (!empty($data->name)) {
            $displayData .= '<li><strong>Name:</strong> ' . esc_html($data->name) . '</li>';
        }
        if (!empty($data->address)) {
            $displayData .= '<li><strong>Address:</strong> ' . esc_html($data->address) . '</li>';
        }
        if (!empty($data->phone)) {
            $displayData .= '<li><strong>Phone:</strong> ' . esc_html($data->phone) . '</li>';
        }
        if (!empty($data->email)) {
            $displayData .= '<li><strong>Email:</strong> ' . esc_html($data->email) . '</li>';
        }
        if (!empty($data->message)) {
            $displayData .= '<li><strong>Message:</strong> ' . esc_html($data->message) . '</li>';
        }

        $displayData .= '</ul>';

        // Mengembalikan data dalam format HTML yang rapi
        echo $displayData;
    } else {
        echo "Data tidak ditemukan.";
    }

    wp_die(); // Penting untuk mengakhiri koneksi dan mengembalikan respons
}


add_action('wp_ajax_get_data', 'get_data_callback');
add_action('wp_ajax_nopriv_get_data', 'get_data_callback');

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
