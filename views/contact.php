<?php include 'start.php' ?>

<body style="background-color:#EDEDED;">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="row pt-5">
                    <div class="card col-md-12 shadow" style="border:3px solid #2B2730;background-color:#F9F5EB;">
                        <div class="row pt-4 ms-2">
                            <div class="col-md-3">
                                <h4 style="font-family:berlin sans fb;color:#22A39F;"> Hasil Contact</h4>
                            </div>
                        </div>
                        <hr class="col-md-12">
                        <div class="card-body" style="font-family:Tw Cen MT;">
                            <div class="table-responsive bs-example widget-shadow">
                                <table id="example" class="table table-striped table-hover table-bordered mt-2">
                                    <thead>
                                        <tr>
                                            <th style="color:#FD841F;" class="text-center">No</th>
                                            <th style="color:#FD841F;" class="text-center">Name</th>
                                            <th style="color:#FD841F;" class="text-center">Addres</th>
                                            <th style="color:#FD841F;" class="text-center">Phone</th>
                                            <th style="color:#FD841F;" class="text-center">Email</th>
                                            <th style="color:#FD841F;" class="text-center">Message</th>
                                            <th style="color:#FD841F;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    global $wpdb;
                                    $table_name = $wpdb->prefix . 'contact_form';
                                    $query = "SELECT * FROM $table_name";
                                    $results = $wpdb->get_results($query);
                                    if ($results) {
                                        $no = 1;
                                        ob_start();
                                    ?>
                                        <tbody>
                                            <?php foreach ($results as $result) { ?>
                                                <tr>
                                                    <?php
                                                    $id = $result->id; ?>
                                                    <td> <?php echo $no++; ?></td>
                                                    <td><?php echo $result->name; ?></td>
                                                    <td>
                                                        <?php
                                                        $address = $result->address;
                                                        if (strlen($address) > 30) {
                                                            $address = substr($address, 0, 30) . '...';
                                                        }
                                                        ?>
                                                        <?php echo $address; ?>
                                                    </td>
                                                    <td><?php echo $result->phone; ?></td>
                                                    <td><?php echo $result->email; ?></td>
                                                    <td>
                                                        <?php
                                                        $message = $result->message;
                                                        if (strlen($message) > 50) {
                                                            $message = substr($message, 0, 50) . '...';
                                                        }
                                                        ?>
                                                        <?php echo $message; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="edit-button" style="text-decoration: none;" data-id="<?php echo $result->id; ?>" data-name="<?php echo $result->name; ?>" data-address="<?php echo $result->address; ?>" data-phone="<?php echo $result->phone; ?>" data-email="<?php echo $result->email; ?>" data-message="<?php echo $result->message; ?>">
                                                            <i class="fa-regular fa-eye" style="color: #216ef2; height: 40px; width: 30px; border-radius: 5px; padding: 5px;"></i>
                                                        </a>
                                                        <a href="<?php echo esc_url(admin_url('admin-post.php?action=delete_data&id=' . $result->id)); ?>" class="Delete">
                                                            <box-icon name='trash' type='solid' color='red' style="height:30px; width:30px; border-radius:5px; padding:5px;"></box-icon>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txt_tgljamView">Name</label>
                                <input type="text" name="name-modal" id="name_modal" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txt_tgljamupdateView">Phone</label>
                                <input type="text" name="phone-modal" id="phone_modal" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txt_tanggalView">Email</label>
                                <input type="text" id="email_modal" name="email-modal" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_tgljamView">Addres</label>
                                <textarea name="addres_modal" id="addres_modal" readonly id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_tgljamupdateView">Message</label>
                                <textarea name="message_modal" id="message_modal" readonly cols="30" rows="10"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<style>
    .dataTables_length {
        display: flex;
        align-items: center;
    }

    .dataTables_length label {
        margin-right: 10px;
    }

    .dataTables_length select {
        width: 45px;
        border-radius: 5px;

    }

    .dataTables_filter input {
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 5px;
        border: 1px solid #000;
        margin-bottom: 10px;
        height: 10px;
    }

    .dataTables_filter input:hover {
        background-color: #f2f2f2;
    }

    .dataTables_filter input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next {
        background-color: #FD841F;
        color: white;
        margin: 2px;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        border-radius: 5px;
        margin-top: -20px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover {
        background-color: #c9dd00;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next.current {
        background-color: #c9dd00;
    }

    textarea {
        overflow-y: scroll;
        height: 100px;
        resize: none;
    }
</style>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "emptyTable": "Tidak Ada Data",
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteLinks = document.querySelectorAll(".Delete");
        deleteLinks.forEach((link) => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                const url = this.getAttribute("href");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel",
                    iconHtml: '<i class="fa fa-trash"></i>',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function() {
                            window.location.href = url;
                        }, 1000);
                        // Show success alert immediately
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var address = $(this).data('address');
            var phone = $(this).data('phone');
            var email = $(this).data('email');
            var message = $(this).data('message');

            //Menampilkan data yang telah diambil ke view modal
            $('#showModal').find('#name_modal').val(name);
            $('#showModal').find('#phone_modal').val(phone);
            $('#showModal').find('#email_modal').val(email);
            $('#showModal').find('#addres_modal').val(address);
            $('#showModal').find('#message_modal').val(message);

            // Menampilkan modal
            $('#showModal').modal('show');
        });
    });
</script>