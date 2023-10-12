<?php include 'start.php';?>
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
if ($data) {
?>

<body style="background-color:#EDEDED;">
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row">
                <div class="card"style="border:3px solid #2B2730;background-color:#F9F5EB;">
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
                    <div class="form-group mt-3">
                        <h6> Message :</h6>
                        <textarea name="text" id="text" cols="60" rows="5"></textarea>
                    </div>
                    <button type="submit" name="submit" class="button_custom col-md-3 mt-4 offset-md-9">Send</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
    .yow{
        padding:<?php echo $data->padding;?>;
        font-family:<?php echo $data->font_family;?>;
        color:<?php echo $data->ft_color;?>
    }
    .button_custom{
        height:45px;
        border-radius:10px;
        font-family:sans-serif;
        border:none;
        background-color: <?php echo $data->button_color;?>;
        color: <?php echo $data->font_color; ?>;
    }
    .button_custom:hover{
        background-color: <?php echo $data->buttton_color_hover;?>;
        color: <?php echo $data->font_color_hover; ?>;
    }
    input[type=text], .tes{
        background-color:#fafafa;
    }
    input[type=email], .tes{
        background-color:#fafafa;
    }

</style>
<?php
 }
 ?>