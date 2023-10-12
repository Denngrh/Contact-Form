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
                                        $no = 1 ;
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
                                                        <a href="#" class="edit-button" data-id="<?php echo $result->id; ?>" data-bs-toggle="modal" data-bs-target="#showModal">
                                                            <i class="fa-regular fa-eye" style="color: #216ef2; height: 40px; width: 30px; border-radius: 5px; padding: 5px;"></i>
                                                        </a>

                                                        <a href="<?php echo esc_url(admin_url('admin-post.php?action=delete_data&id=' . $result->id)); ?>" class="Delete"><box-icon name='trash' type='solid' color='red' style="height:30px; width:30px; border-radius:5px; padding:5px;"></box-icon></a>
                                                    </td>
                                                </tr>
                                            <?php } } ?>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Data akan ditampilkan di sini -->
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
        .dataTables_filter input {
      font-size: 14px;
      padding: 6px 12px;
      border-radius: 5px;
      border: 1px solid #000;
      margin-bottom:10px;
      height : 10px;
    }
    .dataTables_filter input:hover {
      background-color: #f2f2f2;
    }
    .dataTables_filter input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    </style>
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "emptyTable": "Tidak Ada Data",
                "pageLength": 50, // Mengatur panjang halaman awal menjadi 50
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
            $(".edit-button").click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                $.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: "POST",
                    data: {
                        action: "get_data",
                        id: id
                    },
                    success: function(response) {
                        $("#showModal .modal-body").html(response);
                        $("#showModal").modal("show");
                    },
                    error: function() {
                        alert("Terjadi kesalahan saat mengambil data.");
                    }
                });
            });
        });
    </script>