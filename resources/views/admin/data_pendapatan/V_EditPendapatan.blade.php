@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl">
        <div class="header-judul mb-3">
            <div class="row">
                <div class="col-12">
                    <h1>Forms / </span>Edit Pendapatan</h1>
                </div>
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">

                        <form method="POST"
                            action="{{ route('pendapatan.saveedit', ['id_jurnal' => $jurnal->id_jurnal]) }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" class="form-control" name="id_jurnal"
                                    value="{{ $jurnal->id_jurnal }}" readonly>
                                <input type="hidden" class="form-control" name="nama_akun"
                                    value="{{ $jurnal->nama_akun }}" readonly>
                                <input type="hidden" class="form-control" name="status_jurnal"
                                    value="{{ $jurnal->status_jurnal }}"readonly>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Akun</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name"
                                        value="{{ $jurnal->kode_akun }} / {{ $jurnal->nama_akun }}"
                                        placeholder="Masukkan kode akun..." readonly />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Reff Jurnal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        name="reff_jurnal" id="reff_jurnal" value="{{ $jurnal->reff_jurnal }}"
                                        placeholder="Masukkan reff jurnal..." readonly />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_jurnal" name="tanggal_jurnal"
                                        value="{{ optional($jurnal->tanggal_jurnal)->format('Y-m-d') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Nominal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        name="nominal_jurnal" id="nominal_jurnal" value="{{ $jurnal->nominal_jurnal }}"
                                        placeholder="Masukkan nominal jurnal..." />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        name="note_jurnal" id="note_jurnal" value="{{ $jurnal->note_jurnal }}"
                                        placeholder="Masukkan note jurnal..." />
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
