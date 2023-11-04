<?php include 'start.php'; ?>

<?php
global $wpdb;
$custom_table = $wpdb->prefix . 'custom_form';
$data = $wpdb->get_row("SELECT * FROM $custom_table ");
$css_data = json_decode($data->style_form, true); {
?>

    <body style="background-color:#EDEDED;">
        <div class="container-fluid">
            <div class="container">
                <div class="row pt-3">
                    <div class="col-md-6" style="margin-left:-45px;">
                        <div class="card px-5 py-5 col-md-12" style="background-color:#F3EFE0;border:3px solid #2B2730;">
                            <div class="card-title pt-3 <?php echo $css_data['text_alignment']; ?>">
                                <<?php echo $css_data['title_size']; ?> style="color: <?php echo $css_data['title_color']; ?>; font-family:  <?php echo $css_data['title_fam']; ?>;"> <?php echo $css_data['title']; ?></<?php echo $css_data['title_size']; ?>>
                            </div>
                            <div class="yow card-body">
                                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                                    <input type="hidden" name="action" value="ambil_data">
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="text" class="tes form-control" id="show" name="first" placeholder="Name" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_first" id="check_first" class="col-md-5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="text" class="tes form-control" id="recipient-name" name="address" placeholder=" Address" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_address" id="check_address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="number" class="tes form-control" id="recipient-name" name="telpon" placeholder=" Phone" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_number" id="check_number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="email" class="tes form-control" id="recipient-name" name="mail" placeholder=" Email" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_email" id="check_email">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="editor" name="text"></div>
                                    <div class="<?php echo $css_data['button_alignment']; ?>">
                                        <button type="button" class="button_custom col-md-3 mt-4 ">Send</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4" style="background-color:#EDEDED;">
                        <div class="row">
                            <hr>
                            <div class="col-md-6">
                                <h5 style="font-family:berlin sans fb;color:#22A39F;"> CUSTOM DESIGN FORM</h5>
                            </div>
                            <input type="submit" value="Save Custom" name="submit" id="submit" class="button-24 col-md-3 offset-md-3">
                        </div>
                        <h6 class="mt-3" style="font-family:berlin sans fb;color:#FD841F;"> CUSTOM FORM </h6>
                        <input type="hidden" name="id" value="<?php echo $data->id_style; ?>">
                        <div class="form-group mt-3 d-flex">
                            <label class="" style="font-size: 20px;"> Title </label>
                            <input class="form-control" type="text" name="slider_name" value="<?php echo $css_data['title']; ?>" style="width:46%;margin-left:10px;height:5px;">
                        </div>

                        <div class="accordion my-3" id="accordionPanelsStayOpenExample1">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-accordion_1" aria-expanded="false" aria-controls="panelsStayOpen-accordion_1">
                                        Title Custom
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-accordion_1" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="form-group px-md-4 px-4 mt-2 d-flex justify-content-between">
                                            <label>Title Size</label>
                                            <select name="title_size" id="title_size">
                                                <option value="<?php echo $css_data['title_size']; ?>"><?php echo $css_data['title_size']; ?></option>
                                                <option value="h1" style="font-size:40px;">h1</option>
                                                <option value="h2" style="font-size:34px;">h2</option>
                                                <option value="h3" style="font-size:28px;">h3</option>
                                                <option value="h4" style="font-size:24px;">h4</option>
                                                <option value="h5" style="font-size:20px;">h5</option>
                                                <option value="h6" style="font-size:16px;">h6</option>
                                            </select>
                                        </div>
                                        <div class="select px-md-4 px-4 mt-2 d-flex justify-content-between">
                                            <label>Font</label>
                                            <select name="title_fam" id="title_fam">
                                                <option value="<?php echo $css_data['title_fam']; ?>"><?php echo $css_data['title_fam']; ?></option>
                                                <option value="sans-serif" style="font-family:sans-serif;">Sans Serif</option>
                                                <option value="serif" style="font-family:serif;">Serif</option>
                                                <option value="fantasy" style="font-family:fantasy;">Fantasy</option>
                                                <option value="Verdana" style="font-family:Verdana;">Verdana</option>
                                            </select>
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between">
                                            <label> Color </label>
                                            <input class="form-control" type="color" name="title_color" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['title_color']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion my-3" id="accordionPanelsStayOpenExample2">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse2" aria-expanded="false" aria-controls="panelsStayOpen-collapse2">
                                        Form Custom
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="px-4 d-flex justify-content-between px-md-4 ">
                                            <label>Padding</label>
                                            <input type="number" class="form-control border border-1" id="padding" name="padding" style="background-color:white;height:3px;width:50%;margin-left:48px;" value="<?php echo str_replace('px', '', $css_data['padding']); ?>">
                                            <span class="input-group-text" style="padding:2px;">px</span>
                                        </div>
                                        <div class="select px-md-4 px-4 d-flex justify-content-between mt-2">
                                            <label>Font</label>
                                            <select name="font_fam" id="font_fam">
                                                <option value="<?php echo $css_data['font_fam']; ?>"><?php echo $css_data['font_fam']; ?></option>
                                                <option value="sans-serif" style="font-family:sans-serif;">Sans Serif</option>
                                                <option value="serif" style="font-family:serif;">Serif</option>
                                                <option value="fantasy" style="font-family:fantasy;">Fantasy</option>
                                                <option value="Verdana" style="font-family:Verdana;">Verdana</option>
                                            </select>
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between">
                                            <label> Color </label>
                                            <input class="form-control" type="color" name="ft_color" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['ft_color']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="border_form" class="accordion my-3" id="accordionPanelsStayOpenExample5">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse6" aria-expanded="false" aria-controls="panelsStayOpen-collapse6">
                                        Border
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse6" class="accordion-collapse collapse show">
                                    <div class="accordion-body d-flex justify-content-between">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="border_option" id="border_none_input" value="none">
                                            <label class="form-check-label" for="border_none" id="border_none_label">
                                                None
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="border_option" id="border_show_input" value="1px solid #d2d2d2">
                                            <label class="form-check-label" for="border_show" id="border_show_label">
                                                Show
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h6 class="mt-3" style="font-family:berlin sans fb;color:#FD841F;"> CUSTOM BUTTON </h6>
                        <div class="accordion my-3" id="accordionPanelsStayOpenExample3">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse4" aria-expanded="false" aria-controls="panelsStayOpen-collapse4">
                                        Button Custom
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse4" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between">
                                            <label id="dots_color_label"> backround color </label>
                                            <input class="form-control" type="color" id="button_color" name="button_color" style="width:50%;height:25px;" value="<?php echo $css_data['backround_color']; ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between">
                                            <label> Font Color </label>
                                            <input class="form-control" type="color" id="font_color-name" name="font_color" style="width:50%;height:25px;" value="<?php echo $css_data['font_color']; ?>">
                                        </div>
                                        <hr class="my-3 ms-4" width="75%;">
                                        <p class="ms-md-4"> Hover </p>
                                        <div class="form-group px-md-4 px-4 mt-2 d-flex justify-content-between">
                                            <label> backround color </label>
                                            <input class="form-control" type="color" id="button_color_hover-color" name="button_color_hover" style="width:50%;height:25px;" value="<?php echo $css_data['hover_color']; ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4 mt-2 d-flex justify-content-between">
                                            <label> Font Color </label>
                                            <input class="form-control" type="color" id="font_color_hover-name" name="font_color_hover" style="width:50%;height:25px;" value="<?php echo $css_data['font_hover']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-2" style="font-family:berlin sans fb;color:#FD841F;"> CUSTOM POSITION </h6>
                        <div class="accordion my-3" id="accordionPanelsStayOpenExample7">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse7" aria-expanded="false" aria-controls="panelsStayOpen-collapse7">
                                        Position
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse7" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="text-center mb-3">
                                            <p>Position Title</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="text_alignment" id="text_left_input" value="text-left">
                                                <label class="form-check-label" for="text_left_input">
                                                    Left
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="text_alignment" id="text_center_input" value="text-center">
                                                <label class="form-check-label" for="text_center_input">
                                                    Center
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="text_alignment" id="text_right_input" value="text-end">
                                                <label class="form-check-label" for="text_right_input">
                                                    Right
                                                </label>
                                            </div>
                                        </div>
                                        <hr class="my-3">
                                        <div class="text-center">
                                            <p>Position Button</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="button_alignment" id="button_left_input" value="text-left">
                                                <label class="form-check-label" for="button_left_input">
                                                    Left
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="button_alignment" id="button_center_input" value="text-center">
                                                <label class="form-check-label" for="button_center_input">
                                                    Center
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="button_alignment" id="button_right_input" value="text-end">
                                                <label class="form-check-label" for="button_right_input">
                                                    Right
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <hr class="mt-5">
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- Js for cheked position button -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cssData = "<?php echo $css_data['button_alignment']; ?>";

            var textLeftInput = document.getElementById('button_left_input');
            var textCenterInput = document.getElementById('button_center_input');
            var textRightInput = document.getElementById('button_right_input');

            // Setel radio button berdasarkan nilai yang diambil dari database
            if (cssData === 'text-left') {
                textLeftInput.checked = true;
            } else if (cssData === 'text-center') {
                textCenterInput.checked = true;
            } else if (cssData === 'text-end') {
                textRightInput.checked = true;
            }
        });
    </script>

    <!-- Js for cheked position title -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cssData = "<?php echo $css_data['text_alignment']; ?>";

            var textLeftInput = document.getElementById('text_left_input');
            var textCenterInput = document.getElementById('text_center_input');
            var textRightInput = document.getElementById('text_right_input');

            // Setel radio button berdasarkan nilai yang diambil dari database
            if (cssData === 'text-left') {
                textLeftInput.checked = true;
            } else if (cssData === 'text-center') {
                textCenterInput.checked = true;
            } else if (cssData === 'text-end') {
                textRightInput.checked = true;
            }
        });
    </script>

    <!-- Js for cheked border -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const borderOption = "<?php echo $css_data['border']; ?>";

            // Cari elemen radio button dengan ID yang sesuai
            var borderNoneInput = document.getElementById('border_none_input');
            var borderShowInput = document.getElementById('border_show_input');

            // Tentukan radio button mana yang harus dicentang berdasarkan nilai borderOption
            if (borderOption === 'none') {
                borderNoneInput.checked = true;
            } else if (borderOption === '1px solid #d2d2d2') {
                borderShowInput.checked = true;
            }
        });
    </script>

    <!-- Js for accordion hide view -->
    <script>
        $(document).ready(function() {
            $('.collapse').collapse('hide');
        });
    </script>

    <!-- Js for Textarea editor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- Js for set Checkbox -->
    <script>
        function saveCheckboxStatus(checkboxName) {
            const checkbox = document.querySelector(`[name="${checkboxName}"]`);
            if (checkbox) {
                localStorage.setItem(checkboxName, checkbox.checked);
            }
        }

        function restoreCheckboxStatus(checkboxName) {
            const checkbox = document.querySelector(`[name="${checkboxName}"]`);
            if (checkbox) {
                const checked = localStorage.getItem(checkboxName) === 'true';
                checkbox.checked = checked;
            }
        }

        // Panggil fungsi restoreCheckboxStatus saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            restoreCheckboxStatus('check_first');
            restoreCheckboxStatus('check_address');
            restoreCheckboxStatus('check_number');
            restoreCheckboxStatus('check_email');
        });

        document.addEventListener('change', (event) => {
            if (event.target.type === 'checkbox') {
                saveCheckboxStatus(event.target.name);
            }
        });
    </script>


    <style>
        #wpfooter {
            display: none;
        }

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 100px;
        }

        .accordion {
            width: 300px;
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

        input[type=text],
        .tes {
            background-color: #fafafa;
        }

        input[type=email],
        .tes {
            background-color: #fafafa;
        }

        .frm {
            font-family: Tw Cen MT;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 150px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .password-toggle i {
            color: #888;
        }

        .password-toggle i:hover {
            color: #000;
        }

        /* CSS */
        .button-24 {
            background: #FD841F;
            border: 1px solid #FD841F;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
            border-radius: 6px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: Berlin Sans FB;
            font-size: 16px;
            font-weight: 800;
            line-height: 16px;
            min-height: 40px;
            outline: 0;
            padding: 8px 10px;
            text-align: center;
            text-rendering: geometricprecision;
            text-transform: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
        }

        .button-24:hover,
        .button-24:active {
            background-color: #22A39F;
            background-position: 0 0;
            color: #ffffff;
        }

        .button-24:active {
            opacity: .5;
        }
    </style>

<?php
}
?>