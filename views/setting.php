<?php include 'start.php' ?>

<?php
global $wpdb;
$table_name = $wpdb->prefix . 'setting_form';
$data = $wpdb->get_row("SELECT * FROM $table_name");
if ($data) {
?>

  <body style="background-color:#EDEDED;">
    <div class="container-fluid">
      <div class="container">
        <div class="row pt-5">
          <div class="card col-md-10 offset-md-1 shadow" style="border:3px solid #2B2730;background-color:#F9F5EB;">
            <div class="row">
              <h3 style="font-family:berlin sans fb;color:#22A39F;">SMTP Setting </h3>
            </div>
            <div class="row">
              <div class="col-md-4 mt-3 px-5 mx-1" style="border-right:1px solid gray;">
                <!-- UserName -->
                <h6 style="font-family:berlin sans fb;color:#FD841F;"> Email</h6>
                <p style="font-family:Tw Cen MT;font-size:13px;"> Akun email yang akan digunakan untuk mengirim email.</p>
                <!-- Pass -->
                <h6 style="font-family:berlin sans fb;color:#FD841F;"> Password</h6>
                <p style="font-family:Tw Cen MT;font-size:13px;">Kata sandi dua faktor email yang akan digunakan untuk mengirim email.</p>
                <!-- Host -->
                <h6 style="font-family:berlin sans fb;color:#FD841F;"> Host</h6>
                <p style="font-family:Tw Cen MT;font-size:13px;">Host atau server SMTP yang digunakan untuk mengirim email. Misalnya, "smtp.gmail.com" untuk Gmail.</p>
                <!-- Port -->
                <h6 style="font-family:berlin sans fb;color:#FD841F;"> Port</h6>
                <p style="font-family:Tw Cen MT;font-size:13px;"> Port yang digunakan oleh server SMTP. Misalnya port 587 untuk TLS atau 465 untuk SSL.</p>
                <!-- to -->
                <h6 style="font-family:berlin sans fb;color:#FD841F;"> Set for </h6>
                <p style="font-family:Tw Cen MT;font-size:13px;"> Nama akun email yang menerima pesan kita.</p>

              </div>
              <div class="col-md-7 px-5">
                <h6 style="font-family:berlin sans fb;color:#FD841F;"> Setting</h6>
                <p style="font-family:Tw Cen MT;font-size:15px;"> Setelah melihat panduannya, isikan setting smtp dibawah ini</p>
                <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                  <input type="hidden" name="action" value="update_setting">
                  <input type="hidden" name="id" value="<?php echo $data->id_setting; ?>">
                  <div class="frm form-group">
                    <label for="recipient-name" class="col-form-label pt-1">Email:</label>
                    <input type="email" class="form-control mt-1" id="username" name="username" placeholder="Email" value="<?php echo $data->username; ?>" required>
                  </div>
                  <div class="frm form-group">
                    <label for="recipient-name" class="col-form-label">Password:</label>
                    <input type="password" class="form-control mt-1" id="pass" name="pass" placeholder="Password" value="<?php echo $data->password; ?>" required> <span class="password-toggle" onclick="togglePasswordVisibility()"><i id="eye-icon" class="fa fa-eye"></i></span>
                  </div>
                  <div class="row">
                    <div class="frm form-group col-md-7">
                      <label for="recipient-name" class="col-form-label">Host:</label>
                      <input type="text" class="form-control mt-1" id="host" name="host" placeholder="Host" value="<?php echo $data->host; ?>" required>
                    </div>
                    <div class="frm form-group col-md-3">
                      <label for="recipient-name" class="col-form-label">Port:</label>
                      <input type="number" class="form-control mt-1" id="port" name="port" placeholder="Port" value="<?php echo $data->port; ?>" required>
                    </div>
                  </div>
                  <div class="frm form-group">
                    <label for="recipient-name" class="col-form-label">Set For Email:</label>
                    <input type="email" class="form-control mt-1" id="for" name="for" placeholder="Set for" value="<?php echo $data->set_for; ?>" required>
                  </div>
                  <button type="submit" name="submit" value="send" class="button-24 mt-4 mb-3 col-md-5 offset-md-7">Update Setting</button>
                </form>
              <?php
            }
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <style>
    #wpfooter {
      display: none;
    }

    .password-toggle {
      position: absolute;
      margin-left: 425px;
      top: 251px;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .password-toggle i {
      color: #888;
    }

    .password-toggle i:hover {
      color: #000;
    }

    .frm {
      font-family: Tw Cen Mt;
    }

    /* CSS */
    .button-24 {
      background: #FD841F;
      border: 1px solid #FD841F;
      border-radius: 6px;
      box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
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
      padding: 12px 14px;
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
      color: #FFFFFF;
    }

    .button-24:active {
      opacity: .5;
    }
  </style>

  <script>
    function togglePasswordVisibility() {
      var passwordField = document.getElementById("pass");
      var eyeIcon = document.getElementById("eye-icon");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
      }
    }
  </script>