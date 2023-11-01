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
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js'></script>
    </head>

    <body>
        <div class="container-fluid pt-5">
            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="card-title pt-3  <?php echo $css_data['text_alignment']; ?>">
                            <<?php echo $css_data['title_size']; ?> style="color: <?php echo $css_data['title_color']; ?>; font-family:  <?php echo $css_data['title_fam']; ?>;"> <?php echo $css_data['title']; ?></<?php echo $css_data['title_size']; ?>>
                        </div>
                        <div class="yow card-body">
                            <form id="my-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                                <input type="hidden" name="action" value="insert_data">
                                <?php
                                if ($first) {
                                    echo ' <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control col-md-8" id="first" name="first" placeholder="Name" autocomplete="off" maxlength="25" required>
                                    </div>';
                                }
                                if ($address) {
                                    echo '<div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Addres</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" autocomplete="off" maxlength="80" required>
                                    </div>';
                                }
                                if ($phone) {
                                    echo '<div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Phone</label>
                                        <input type="text" class="form-control" id="number" name="number" placeholder="Number" autocomplete="off" maxlength="14" required>
                                    </div>';
                                }
                                if ($email) {
                                    echo '<div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="25" required>  
                                    </div>';
                                }
                                ?>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Message</label>
                                    <textarea name="text" id="editor"></textarea>
                                </div>
                                <div class="<?php echo $css_data['button_alignment']; ?>">
                                    <button type="submit" name="submit" class="button_custom col-md-3 mt-4">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'undo',
                        'redo'
                    ]
                },
                image: {
                    toolbar: [
                        'imageTextAlternative'
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        document.getElementById("number").addEventListener("input", function() {
            var input = this.value;
            // Hapus karakter yang bukan angka
            this.value = input.replace(/\D/g, '');
        });
    </script>

    <style>
        .ck-editor__editable[role="textbox"] {
            color: black;
            background-color: white;
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