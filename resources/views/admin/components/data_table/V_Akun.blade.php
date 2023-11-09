{{-- Show Data Akun --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.data-akun').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('akun.dataakun') }}",
            columns: [{
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'kode_akun',
                    name: 'kode_akun'
                },
                {
                    data: 'nama_akun',
                    name: 'nama_akun'
                },
                {
                    data: 'tipe_akun',
                    name: 'tipe_akun'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });
</script>
