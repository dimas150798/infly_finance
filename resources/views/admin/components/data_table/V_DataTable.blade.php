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

{{-- Show Data Jurnal --}}
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('.data-jurnal').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('jurnal.datajurnal') }}",
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                },
            },
            columns: [{
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'tanggal_jurnal',
                    name: 'tanggal_jurnal'
                },
                {
                    data: 'nama_akun',
                    name: 'nama_akun'
                },
                {
                    data: 'reff_jurnal',
                    name: 'reff_jurnal'
                },
                {
                    data: 'nominal_jurnal',
                    name: 'nominal_jurnal'
                },
                {
                    data: 'note_jurnal',
                    name: 'note_jurnal'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        // Handler untuk pembaruan ketika tombol pencarian diklik
        $('#searchButton').on('click', function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            // Kirim permintaan AJAX ke URL pencarian dengan parameter tanggal
            table.ajax.url("{{ route('jurnal.datajurnal') }}?start_date=" + start_date + "&end_date=" +
                end_date).load();
        });
    });
</script>

{{-- Show Data Buku Besar --}}
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('.buku-besar').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('bukubesar.bukubesar') }}",
                data: function(d) {
                    d.bulan = $('#bulan').val();
                    d.tahun = $('#tahun').val();
                    d.nama_akun = $('#nama_akun').val();
                },
            },
            columns: [{
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'tanggal_jurnal',
                    name: 'tanggal_jurnal'
                },
                {
                    data: 'nama_akun',
                    name: 'nama_akun'
                },
                {
                    data: 'reff_jurnal',
                    name: 'reff_jurnal'
                },
                {
                    data: 'nominal_debit',
                    name: 'nominal_debit'
                },
                {
                    data: 'nominal_kredit',
                    name: 'nominal_kredit'
                },
                {
                    data: 'note_jurnal',
                    name: 'note_jurnal'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        // Handler untuk pembaruan ketika tombol pencarian diklik
        $('#searchButton').on('click', function() {
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var nama_akun = $('#nama_akun').val();

            // Kirim permintaan AJAX ke URL pencarian dengan parameter tanggal
            table.ajax.url("{{ route('bukubesar.bukubesar') }}?bulan=" + bulan +
                "&tahun=" +
                tahun).load();
        });
    });
</script>
