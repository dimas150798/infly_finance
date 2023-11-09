@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4><span class="text-muted fw-light">Forms /</span> Nama Akun</h4>
        </div>

        <hr class="col-12 hr-style mb-4">

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="<?= url('akun/simpantambahakun') ?>" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Akun <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bi bi-receipt"></i></span>
                                        <input type="text" class="form-control" id="basic-default-name"
                                            name="kode_akun" id="kode_akun" value="{{ old('kode_akun') }}"
                                            placeholder="Masukkan kode akun..." />
                                    </div>
                                    @if ($errors->has('kode_akun'))
                                        <div class="alert-form">
                                            <ul>
                                                @foreach ($errors->get('kode_akun') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Akun <span
                                        class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bi bi-chat-square-text"></i></span>
                                        <input type="text" class="form-control" id="basic-default-company"
                                            name="nama_akun" id="nama_akun" value="{{ old('nama_akun') }}"
                                            placeholder="Masukkan nama akun..." />
                                    </div>
                                    @if ($errors->has('nama_akun'))
                                        <div class="alert-form">
                                            <ul>
                                                @foreach ($errors->get('nama_akun') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Tipe Akun <span
                                        class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bi bi-chat-square-text"></i></span>
                                        <input type="text" class="form-control" id="basic-default-company"
                                            name="tipe_akun" id="tipe_akun" value="{{ old('tipe_akun') }}"
                                            placeholder="Masukkan tipe akun..." />
                                    </div>
                                    @if ($errors->has('tipe_akun'))
                                        <div class="alert-form">
                                            <ul>
                                                @foreach ($errors->get('tipe_akun') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
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
