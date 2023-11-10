@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4><span class="text-muted fw-light">Forms Edit /</span> Nama Akun</h4>

        <hr class="col-12 hr-style mb-4">

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">

                        <form method="POST" action="{{ route('akun.simpaneditakun', ['id_akun' => $akun->id_akun]) }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Akun</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="kode_akun"
                                        id="kode_akun" value="{{ $akun->kode_akun }}"
                                        placeholder="Masukkan kode akun..." />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Akun</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        name="nama_akun" id="nama_akun" value="{{ $akun->nama_akun }}"
                                        placeholder="Masukkan nama akun..." />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Tipe Akun</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        name="tipe_akun" id="tipe_akun" value="{{ $akun->tipe_akun }}"
                                        placeholder="Masukkan tipe akun..." />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="button-simpan" role="button">Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@include('admin/components/layouts/V_Footer')
