@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-5">
                <h4><span class="text-muted fw-light">Data Buku Besar /</span> Table</h4>
            </div>
            <div class="col-7 d-flex justify-content-end">
                <div class="dropdown-fitur">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Fitur
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item export-excel" href="<?= url('bukubesar/exporttoexcel') ?>"><i
                                    class="bi bi-file-earmark-spreadsheet-fill text-warning "></i> Export Excel</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="col-12 hr-style mb-4">

        <!-- Basic Bootstrap Table -->
        <div class="row mb-3">
            <div class="col-md-3 mb-3">
                <select id="bulan" name="bulan" class="form-control">
                    <option value="">Pilih Bulan</option>
                    <?php
                    
                    $bulanSesi = session('bulan', now()->format('n'));
                    
                    $bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    foreach ($bulanList as $index => $namaBulan) {
                        $selected = $bulanSesi == $index + 1 ? 'selected' : '';
                        echo "<option value='" . ($index + 1) . "' $selected>$namaBulan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <select id="tahun" name="tahun" class="form-control">
                    <option value="">Pilih Tahun</option>
                    <?php
                    $tahunSesi = session('tahun', now()->format('Y'));
                    
                    for ($tahun = 2023; $tahun <= 2027; $tahun++) {
                        $selected = $tahunSesi == $tahun ? 'selected' : '';
                        echo "<option value='$tahun' $selected>$tahun</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <select id="nama_akun" name="nama_akun" class="form-control">
                    <option value="">Pilih Nama Akun</option>
                    <?php foreach ($options as $akun): ?>
                    <option value="<?= $akun['nama_akun'] ?>"
                        <?= session('nama_akun') == $akun['nama_akun'] ? 'selected' : '' ?>>
                        <?= $akun['nama_akun'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 mb-3 d-flex justify-content-end">
                <button id="searchButton" class="searchButton">Search</button>
            </div>
        </div>


        <div class="card">
            <div class="container p-3">
                <table class="table table-bordered buku-besar" id="buku-besar">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Tanggal</th>
                            <th>Nama Akun</th>
                            <th>Reff</th>
                            <th>Nominal Debit</th>
                            <th>Nominal Kredit</th>
                            <th>Note Jurnal</th>
                            {{-- <th style="width: 15%">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

@include('admin/components/layouts/V_Footer')
