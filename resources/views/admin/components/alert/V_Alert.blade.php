{{-- Sukses Alert --}}
@if (Session::has('alert-success'))
    <script>
        toastr.options = {
            "progressBar": true,
        }
        toastr.success("{{ Session::get('alert-success') }}");
    </script>
@endif

{{-- Gagal Alert --}}
@if (Session::has('alert-gagal'))
    <script>
        toastr.options = {
            "progressBar": true,
        }
        toastr.error("{{ Session::get('alert-gagal') }}");
    </script>
@endif

{{-- Logout Alert --}}
<script>
    function ConfirmLogout() {
        Swal.fire({
            title: 'Logout Aplikasi ?',
            text: 'You will be logged out.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, log me out',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form element to send a POST request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/logout'; // Replace with your logout route or URL

                // Create a CSRF token input (assuming you're using Laravel's CSRF protection)
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token'; // Replace with the name of your CSRF token field
                csrfToken.value = '{{ csrf_token() }}'; // Use Laravel's way to get the CSRF token

                // Append the CSRF token input to the form
                form.appendChild(csrfToken);

                // Append the form to the body and submit it
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

{{-- Edit Data --}}
<script>
    $(document).on('click', '.edit-alert', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        Swal.fire({
            title: "Yakin Melakukan Edit ?",
            text: "Data Yang Diedit Tidak Bisa Kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Edit",
            cancelButtonText: "Cancel"
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>

{{-- Delete data --}}
<script>
    $(document).on('click', '.delete-alert', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var deleteUrl = $(this).attr('href');
        var trObj = $(this).closest("tr");

        Swal.fire({
            title: "Yakin Melakukan Delete?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete",
            cancelButtonText: "Cancel"
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'GET', // Use 'DELETE' for a deletion operation
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            trObj.remove();
                            Swal.fire('Deleted!', 'The user has been deleted.', 'success');
                        } else {
                            Swal.fire('Error!', 'Failed to delete user: ' + data.error,
                                'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error!', 'An error occurred while deleting the user.',
                            'error');
                    }
                });
            }
        });
    });
</script>

{{-- Download Excel --}}
<script>
    $(document).on('click', '.export-excel', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        Swal.fire({
            title: "Download Data Excel ?",
            text: "Data Yang Di Download Berdasarkan Tanggal Yang Dicari!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Download",
            cancelButtonText: "Cancel"
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>

{{-- Posting Jurnal --}}
<script>
    $(document).on('click', '.posting', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        Swal.fire({
            title: "Posting Ke Buku Besar ?",
            text: "Posting Berdasarkan Tanggal Yang Dicari!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Posting",
            cancelButtonText: "Cancel"
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>
