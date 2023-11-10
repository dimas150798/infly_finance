@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4><span class="text-muted fw-light">Forms /</span> Data Kredit</h4>
        </div>

        <hr class="col-12 hr-style mb-4">

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">

                        <form action="<?= url('jurnal/simpantambahkredit') ?>" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Tanggal <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                                        <input type="date" class="form-control" id="tanggal_kredit"
                                            name="tanggal_kredit" value="{{ old('tanggal_kredit') }}" />
                                    </div>
                                    @if ($errors->has('tanggal_kredit'))
                                        <div class="alert-form">
                                            <ul>
                                                @foreach ($errors->get('tanggal_kredit') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Akun <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <select id="nama_akun" name="nama_akun" class="form-select">
                                        <option value=""></option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option->nama_akun }}"
                                                {{ old('nama_akun') == $option->nama_akun ? 'selected' : '' }}>
                                                {{ $option->nama_akun }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Reff <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bi bi-receipt"></i></span>
                                        <input type="text" class="form-control" id="reff_kredit" name="reff_kredit"
                                            value="{{ $reff_kredit }}" placeholder="Masukkan reff kredit..." />
                                    </div>
                                    @if ($errors->has('reff_kredit'))
                                        <div class="alert-form">
                                            <ul>
                                                @foreach ($errors->get('reff_kredit') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Nominal</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="bi bi-cash"></i></span>
                                        <input type="text" class="form-control" id="nominal_kredit"
                                            name="nominal_kredit" value="{{ old('nominal_kredit') }}"
                                            placeholder="Masukkan nominal kredit..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"
                                    for="basic-icon-default-message">Keterangan</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bi bi-chat-square-text"></i></span>
                                        <textarea class="form-control" id="note_kredit" name="note_kredit" value="{{ old('note_kredit') }}"
                                            placeholder="Masukkan keterangan..."></textarea>
                                    </div>
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
