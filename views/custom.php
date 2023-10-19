<?php include 'start.php'; ?>

<?php
global $wpdb;
$custom_table = $wpdb->prefix . 'custom_form';
$data = $wpdb->get_row("SELECT * FROM $custom_table ");
if ($data) {
?>

    <body style="background-color:#EDEDED;">
        <div class="container-fluid">
            <div class="container">
                <div class="row pt-3">
                    <div class="col-md-6" style="margin-left:-45px;">
                        <div class="card px-5 py-5 col-md-12" style="background-color:#F3EFE0;border:3px solid #2B2730;">
                            <div class="card-title pt-3">
                                <h3 style="font-family:berlin sans fb;color:#22A39F;"> Pilih Form</h3>
                            </div>
                            <div class="yow card-body">
                                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                                    <input type="hidden" name="action" value="ambil_data">
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="text" class="tes form-control" id="show_first" name="first" placeholder="Name">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_first" id="check_first" class="col-md-5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="text" class="tes form-control" id="recipient-name" name="address" placeholder=" Address">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_address" id="check_address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="number" class="tes form-control" id="recipient-name" name="telpon" placeholder=" Phone">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_number" id="check_number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="email" class="tes form-control" id="recipient-name" name="mail" placeholder=" Email">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="check_email" id="check_email">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="editor" name="text"></div>
                                    <button type="button" class="button_custom col-md-3 mt-4 offset-md-9">Send</button>
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
                        <!-- Custom Form -->
                        <h6 class="mt-3" style="font-family:berlin sans fb;color:#FD841F;"> CUSTOM FORM </h6>
                        <input type="hidden" name="id" value="<?php echo $data->id_style; ?>">
                        <input type="hidden" name="nama" id="" value="<?php echo $data->nama; ?>">

                        <div class="form-group mt-3 d-flex" >
                            <label class="" style="font-size: 20px;"> Title </label>
                            <input class="form-control" type="text" name="slider_name" value="<?php echo $data->nama; ?>" style="width:46%;margin-left:10px;height:5px;">
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
                                                <!-- <option value="<?php echo $css_data['title_size']; ?>"><?php echo $css_data['title_size']; ?></option> -->
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
                                                <!-- <option value="<?php echo $css_data['title_fam']; ?>"><?php echo $css_data['title_fam']; ?></option> -->
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
                                            <input type="number" class="form-control border border-1" id="padding" name="padding" style="background-color:white;height:3px;width:50%;margin-left:48px;" value="<?php echo rtrim($data->padding, 'px'); ?>">
                                            <span class="input-group-text" style="padding:2px;">px</span>
                                        </div>
                                        <div class="select px-md-4 px-4 d-flex justify-content-between mt-2">
                                            <label>Font</label>
                                            <select name="desc_fam" id="desc_fam">
                                                <!-- <option value="<?php echo $css_data['desc_fam']; ?>"><?php echo $css_data['desc_fam']; ?></option> -->
                                                <option value="sans-serif" style="font-family:sans-serif;">Sans Serif</option>
                                                <option value="serif" style="font-family:serif;">Serif</option>
                                                <option value="fantasy" style="font-family:fantasy;">Fantasy</option>
                                                <option value="Verdana" style="font-family:Verdana;">Verdana</option>
                                            </select>
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between">
                                            <label> Color </label>
                                            <input class="form-control" type="color" name="ft_color" placeholder="color" style="width:50%;height:25px;" value="<?php echo $data->ft_color; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="frm form-group col-md-8">
                            <label for="recipient-name" class="col-form-label">Padding:</label>
                            <input type="text" class="form-control" id="padding" name="padding" style="background-color:white; border:none;" value="<?php echo $data->padding; ?>">
                        </div>
                        <div class="frm form-group col-md-8">
                            <label for="recipient-name" class="col-form-label">Font :</label>
                            <input type="text" class="form-control" id="font_family" name="font_family" style="background-color:white; border:none;" value="<?php echo $data->font_family; ?>">
                        </div>
                        <div class="frm form-group col-md-2 ">
                            <label for="recipient-name" class="col-form-label">Font color:</label>
                            <input type="color" class="form-control" id="ft_collor" name="ft_color" value="<?php echo $data->ft_color; ?>">
                        </div> -->
                        <hr class="my-4">
                        <h6 class="mt-3" style="font-family:berlin sans fb;color:#FD841F;"> CUSTOM BUTTON </h6>
                        <h7> First Color</h7>
                        <div class="row">
                            <div class="frm form-group col-md-4 ">
                                <label for="recipient-name" class="col-form-label">Background color:</label>
                                <input type="color" class="form-control" id="button_color" name="button_color" style="width:70px;" value="<?php echo $data->button_color; ?>">
                            </div>
                            <div class="frm form-group col-md-4 ms-4">
                                <label for="recipient-name" class="col-form-label">Font Color :</label>
                                <input type="color" class="form-control" id="font_color-name" name="font_color" style="width:70px;" value="<?php echo $data->font_color; ?>">
                            </div>
                        </div>
                        <h7 class="mt-2"> Hover </h7>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">Background color:</label>
                                <input type="color" class="form-control" id="button_color_hover-color" name="button_color_hover" style="width:70px;" value="<?php echo $data->buttton_color_hover; ?>">
                            </div>
                            <div class="form-group col-md-4 ms-4">
                                <label for="recipient-name" class="col-form-label">Font Color :</label>
                                <input type="color" class="form-control" id="font_color_hover-name" name="font_color_hover" style="width:70px;" value="<?php echo $data->font_color_hover; ?>">
                            </div>
                        </div>
                        </form>
                        <hr class="mt-5">
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            // Menutup semua accordion saat halaman dimuat pertama kali
            $('.collapse').collapse('hide');
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        // Ambil elemen checkbox menggunakan ID atau kelas
        var checkbox = document.getElementById('check_first');

        // Ambil elemen input yang ingin ditampilkan/sembunyikan
        var input = document.getElementById('show_first');

        // Tambahkan event listener ke checkbox
        checkbox.addEventListener('change', function() {
            // Periksa apakah checkbox dicentang
            if (checkbox.checked) {
                // Tampilkan input jika checkbox dicentang
                input.style.display = 'block';
            } else {
                // Sembunyikan input jika checkbox tidak dicentang
                input.style.display = 'none';
            }
        });
    </script>

    <style>
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
            background-color: <?php echo $data->button_color; ?>;
            color: <?php echo $data->font_color; ?>;
        }

        .button_custom:hover {
            background-color: <?php echo $data->buttton_color_hover; ?>;
            color: <?php echo $data->font_color_hover; ?>;
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