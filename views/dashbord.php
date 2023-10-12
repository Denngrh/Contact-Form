<?php include 'start.php'; ?>

<body style="background-color:#EDEDED;">
    <!-- First Page -->
    <div class="container-fluid">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-12 text-center pt-3">
                    <h2>Contact Form </h2>
                    <p>Plugin Wordpress untuk mengirimkan email <br> dari situs web anda sendiri</p>
                </div>
                <div class="col-md-12">
                    <img src="https://www.shipwire.com/wp-content/themes/shipwire/assets/images/contact/Contact_Us.svg" alt="" class="col-md-4 offset-md-4">
                </div>
            </div>
        </div>
    </div>
    <!-- End First Page -->
    <hr class="my-5">
    <!-- Menu's-->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-3">
                    <h2>Lihat Menu Atau Fitur</h2>
                </div>
            </div>
            <div class="row">
            <div class="card col-md-5" style="background-color:#EDEDED;border:none;">
                    <div class="card-body">
                        <h5 class="card-title">Hasil Terkirim</h5>
                        <p class="card-text">Hasil terkirim adalah hasil dari kita menginput data yang jika berhasil maka akan masuk kedalam halaman hasil.</p>
                        <a href="admin.php?page=Contact" class="card-link">Get Started</a>
                    </div>
                </div>
                <div class="card col-md-5 mx-5" style="background-color:#EDEDED;border:none;">
                    <div class="card-body">
                        <h5 class="card-title">Custom Form</h5>
                        <p class="card-text">Custom form adalah custom untuk setting formulir apa yang akan di tampilkan dan style tampilan formulir.</p>
                        <a href="admin.php?page=Style-form" class="card-link">Get Started</a>
                    </div>
                </div>
                <div class="card col-md-5" style="background-color:#EDEDED;border:none;">
                    <div class="card-body">
                        <h5 class="card-title">SMTP Setting</h5>
                        <p class="card-text">SMTP Setting adalah Setting untuk proses pengiriman ke email, pengaturan SMTP sangat penting agar plugin berjalan dengan sempurna.</p>
                        <a href="admin.php?page=Smtp-setting" class="card-link">Get Started</a>
                    </div>
                </div>
                <div class="card col-md-5 mx-5" style="background-color:#EDEDED;border:none;">
                    <div class="card-body">
                        <h5 class="card-title">Hasil Form</h5>
                        <p class="card-text">Hasil form adalah hasil ketika pengguna sudah custom form dan setting SMTP</p>
                        <a href="admin.php?page=Example-form" class="card-link">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Menu's-->
    <hr class="my-5">
    <!--ShortCode-->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2> ShortCode </h2>
                </div>
                <div class="card col-md-4 text-center offset-md-4" style="border: 2px solid #2B2730; background-color: #F9F5EB; height: 50px; position: relative;">
                    <h3>[smt_contact_form]</h3>
                    <button class="copy-button" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px; border: none; background: transparent;"><i class="fa-solid fa-copy" style="color: white; background-color: #FD841F; padding: 3px; border-radius: 5px;"></i></button>
                </div>

            </div>
        </div>
    </div>
    <!-- end ShortCode -->
    <!--Footer-->
    <footer class="text-center text-lg-start mt-5 ">
        <div class="text-center p-3">
            &copy; Copyright <strong><span>2023</span></strong> All Rights Reserved 🚀
            <div class="credits">
                <strong> <a class="text-dark" style="text-decoration:none" href="https://www.smooets.com/">smooets.com</a>
                    | Developer</strong>
            </div>
        </div>
    </footer>
    <!--End Footer-->

</body>


<style>
    .colored-toast.swal2-icon-success {
        background-color: #F9F5EB !important;
    }

    .colored-toast {
        margin-top: 35px;
    }

    h2 {
        font-family: Berlin sans FB;
        color: #22A39F;
        font-size: 35px;
    }

    p {
        font-family: Berlin sans FB;
        color: #FD841F;
        font-size: 18px;
    }

    .card-title {
        font-family: Berlin sans FB;
        color: #FD841F;
        font-size: 20px;
    }

    .card-text {
        font-family: Tw Cen MT;
        color: #000;
        ;
        font-size: 18px;
    }

    .card-link {
        font-family: Tw Cen MT;
        color: #00C4FF;
        font-size: 18px;
    }

    footer {
        background-color: #F9F5EB;
        font-family: Berlin Sans FB;
        width: 103%;
        margin-left: -20px;
        margin-right: 0;
        padding-left: 0;
        padding-right: 0;
    }

    h3 {
        font-family: Humanst521 BT;
        color: #000;
        font-size: 18px;
    }
</style>
<script>
    jQuery(document).ready(function($) {
        $('.copy-button').click(function() {
            var shortcodeText = $(this).closest('.card').find('h3').text().trim();
            copyToClipboard(shortcodeText);
            // Show colored toast SweetAlert2
            showColoredToast('success', 'Text successfully copied: ' + shortcodeText);
        });

        // function copy to clipboard
        function copyToClipboard(text) {
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(text).select();
            document.execCommand('copy');
            tempInput.remove();
        }

        // Fungsi untuk menampilkan colored toast dengan SweetAlert2
        function showColoredToast(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                iconColor: 'white',
                width: 400,
                customClass: {
                    popup: 'colored-toast'
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }
    });
</script>