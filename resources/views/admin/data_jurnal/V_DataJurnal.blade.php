@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-5">
                <h4><span class="text-muted fw-light">Data Jurnal /</span> Table</h4>
            </div>
            <div class="col-7 d-flex justify-content-end">
                <div class="dropdown-fitur">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Fitur
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?= url('jurnal/formtambahdebit') ?>"><i
                                    class="bi bi-plus-circle-fill text-warning"></i> Add Debit</a></li>
                        <li><a class="dropdown-item" href="<?= url('jurnal/addKredit') ?>"><i
                                    class="bi bi-plus-circle-fill text-warning"></i> Add Kredit</a></li>
                        <li><a class="dropdown-item export-excel" href="<?= url('jurnal/exportJurnal') ?>"><i
                                    class="bi bi-file-earmark-spreadsheet-fill text-warning "></i> Export Excel</a></li>
                        <li><a class="dropdown-item posting" href="<?= url('bukubesar/postingJurnal') ?>"><i
                                    class="bi bi-floppy-fill text-warning "></i> Posting Buku
                                Besar</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="col-12 hr-style mb-4">

        <!-- Basic Bootstrap Table -->
        <div class="row mb-3">
            <div class="col-md-5 mb-3">
                <input type="date" id="start_date" name="start_date" value="{{ $start_date }}"
                    class="form-control">
            </div>
            <div class="col-md-5 mb-3">
                <input type="date" id="end_date" name="end_date" value="{{ $end_date }}" class="form-control">
            </div>
            <div class="col-md-2 mb-3 d-flex justify-content-end">
                <button id="searchButton" class="searchButton">Search</button>
            </div>
        </div>

        <div class="card">
            <div class="container p-3">
                <table class="table table-bordered data-jurnal" id="data-jurnal">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Tanggal</th>
                            <th>Nama Akun</th>
                            <th>Reff</th>
                            <th>Nominal</th>
                            <th>Note Jurnal</th>
                            <th style="width: 15%">Action</th>
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
