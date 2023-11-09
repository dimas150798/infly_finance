@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<div class="content-wrapper">

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-5">
                <h4><span class="text-muted fw-light">Data Akun /</span> Table</h4>
            </div>
            <div class="col-7 d-flex justify-content-end">
                <div class="dropdown-fitur">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Fitur
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?= url('akun/formtambahakun') ?>"><i
                                    class="bi bi-plus-circle-fill text-warning"></i> Add Akun</a></li>
                        <li><a class="dropdown-item" href="<?= url('akun/exportAkun') ?>"><i
                                    class="bi bi-file-earmark-spreadsheet-fill text-warning"></i> Export Excel</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="col-12 hr-style mb-4">

        <div class="card">
            <div class="container p-3">
                <div class="table-responsive">
                    <table class="table table-bordered data-akun" id="data-akun" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Kode Akun</th>
                                <th style="width: 30%">Nama Akun</th>
                                <th style="width: 20%">Tipe Akun</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Isi tabel Anda -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <div class="content-backdrop fade"></div>
</div>

@include('admin/components/layouts/V_Footer')
