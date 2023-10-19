<?php
$first = get_option('check_first_option', false);
$address = get_option('check_address_option', false);
$phone = get_option('check_number_option', false);
$email = get_option('check_email_option', false);
?>
<?php
global $wpdb;
$custom_table = $wpdb->prefix . 'custom_form';
$data = $wpdb->get_row("SELECT * FROM $custom_table ");
$css_data = json_decode($data->style_form, true); {
?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    </head>

    <body>
        <div class="container-fluid pt-5">
            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="yow card-body">
                            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                                <input type="hidden" name="action" value="insert_data">
                                <?php
                                if ($first) {
                                    echo '<div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control col-md-8" id="first" name="first" placeholder=" Name" autocomplete="off">
                    </div>';
                                }
                                if ($address) {
                                    echo '<div class="form-group">
                        <label for="recipient-name" class="col-form-label">Addres</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" autocomplete="off">
                    </div>';
                                }
                                if ($phone) {
                                    echo '<div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone</label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="Your number" autocomplete="off">
                    </div>';
                                }
                                if ($email) {
                                    echo '<div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your gmail">  
                    </div>';
                                }
                                ?>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Message</label>
                                    <div id="editor" name="text"></div>
                                </div>
                                <button type="submit" name="submit" class="button_custom col-md-3 mt-4 offset-md-9">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 130px;
        }

        .yow {
            padding: <?php echo $css_data['padding']; ?>;
            font-family: <?php echo $css_data['font_fam']; ?>;
            color: <?php echo $css_data['ft_color']; ?>;
        }

        .button_custom {
            height: 45px;
            border-radius: 10px;
            font-family: sans-serif;
            border: none;
            background-color: <?php echo $css_data['backround_color']; ?>;
            color: <?php echo $css_data['font_color']; ?>;
        }

        .button_custom:hover {
            background-color: <?php echo $css_data['hover_color']; ?>;
            color: <?php echo $css_data['font_hover']; ?>;
        }
        .card {
            border: <?php echo $css_data['border']; ?>;
        }
        input[type=text],
        .tes {
            background-color: #fafafa;
        }

        input[type=email],
        .tes {
            background-color: #fafafa;
        }
    </style>

<?php
}
?>