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
                                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="Email" maxlength="25" required>  
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
        #wpfooter {
            display: none;
        }

        .ck-editor__editable[role="textbox"] {
            color: black;
            background-color: white;
            min-height: 130px;
        }

        label[for="recipient-name"]::after {
            content: " *";
            color: red;
        }

        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
            /* Pastikan lebih tinggi dari elemen lain */
        }

        .dot-spinner {
            --uib-size: 2.8rem;
            --uib-speed: .9s;
            --uib-color: #183153;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: var(--uib-size);
            width: var(--uib-size);
        }

        .dot-spinner__dot {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: 100%;
            width: 100%;
        }

        .dot-spinner__dot::before {
            content: '';
            height: 20%;
            width: 20%;
            border-radius: 50%;
            background-color: var(--uib-color);
            transform: scale(0);
            opacity: 0.5;
            animation: pulse0112 calc(var(--uib-speed) * 1.111) ease-in-out infinite;
            box-shadow: 0 0 20px rgba(18, 31, 53, 0.3);
        }

        .dot-spinner__dot:nth-child(2) {
            transform: rotate(45deg);
        }

        .dot-spinner__dot:nth-child(2)::before {
            animation-delay: calc(var(--uib-speed) * -0.875);
        }

        .dot-spinner__dot:nth-child(3) {
            transform: rotate(90deg);
        }

        .dot-spinner__dot:nth-child(3)::before {
            animation-delay: calc(var(--uib-speed) * -0.75);
        }

        .dot-spinner__dot:nth-child(4) {
            transform: rotate(135deg);
        }

        .dot-spinner__dot:nth-child(4)::before {
            animation-delay: calc(var(--uib-speed) * -0.625);
        }

        .dot-spinner__dot:nth-child(5) {
            transform: rotate(180deg);
        }

        .dot-spinner__dot:nth-child(5)::before {
            animation-delay: calc(var(--uib-speed) * -0.5);
        }

        .dot-spinner__dot:nth-child(6) {
            transform: rotate(225deg);
        }

        .dot-spinner__dot:nth-child(6)::before {
            animation-delay: calc(var(--uib-speed) * -0.375);
        }

        .dot-spinner__dot:nth-child(7) {
            transform: rotate(270deg);
        }

        .dot-spinner__dot:nth-child(7)::before {
            animation-delay: calc(var(--uib-speed) * -0.25);
        }

        .dot-spinner__dot:nth-child(8) {
            transform: rotate(315deg);
        }

        .dot-spinner__dot:nth-child(8)::before {
            animation-delay: calc(var(--uib-speed) * -0.125);
        }

        @keyframes pulse0112 {

            0%,
            100% {
                transform: scale(0);
                opacity: 0.5;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }
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