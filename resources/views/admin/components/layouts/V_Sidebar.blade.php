<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="<?= url('admin/dashboard') ?>" class="app-brand-link">
                        <span class="app-brand-logo demo me-1">
                            <span style="color: var(--bs-primary)">
                                <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt="">
                            </span>
                        </span>
                        <span class="app-brand-text demo menu-text fw-semibold ms-2">Finance</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <!-- Dashboards -->
                    <li class="{{ request()->is('admin/dashboard') ? 'menu-item active' : 'menu-item' }}">
                        <a href="<?= url('admin/dashboard') ?>" class="menu-link">
                            <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                            <div data-i18n="Basic">Dashboards</div>
                        </a>
                    </li>

                    <!-- Data Master -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Master</span></li>
                    <!-- Data Akun -->
                    <li
                        class="{{ request()->is('akun/dataakun') || request()->is('admin/debit') ? 'menu-item active' : 'menu-item' }}">
                        <a href="<?= url('akun/dataakun') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bi bi-person-bounding-box"></i>
                            <div data-i18n="Basic">Data Akun</div>
                        </a>
                    </li>
                    <!-- Data Jurnal -->
                    <li
                        class="{{ request()->is('jurnal/datajurnal') || request()->is('jurnal/dataDebit') || request()->is('jurnal/dataKredit') ? 'menu-item active' : 'menu-item' }}">
                        <a href="<?= url('jurnal/datajurnal') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bi bi-card-checklist"></i>
                            <div data-i18n="Basic">Data Jurnal</div>
                        </a>
                    </li>
                    <!-- Data Jurnal -->
                    <li class="{{ request()->is('bukubesar/bukuBesar') ? 'menu-item active' : 'menu-item' }}">
                        <a href="<?= url('bukubesar/bukuBesar') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bi bi-book-half"></i>
                            <div data-i18n="Basic">Buku Besar</div>
                        </a>
                    </li>
                    {{-- <li
                        class="{{ request()->is('/admin/kredit') || request()->is('admin/debit') ? 'menu-item active open' : 'menu-item' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                            <div data-i18n="Form Elements">Kredit & Debit</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="{{ request()->is('admin/kredit') ? 'menu-item active' : 'menu-item' }}">
                                <a href="<?= url('admin/kredit') ?>" class="menu-link">
                                    <div data-i18n="Basic Inputs">Kredit</div>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/debit') ? 'menu-item active' : 'menu-item' }}">
                                <a href="<?= url('admin/debit') ?>" class="menu-link">
                                    <div data-i18n="Basic Inputs">Debit</div>
                                </a>
                            </li>
                        </ul>
                    </li> --}}


                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="mdi mdi-menu mdi-24px"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/1.png" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                    <li>
                                        <a class="dropdown-item pb-2 mb-1" href="#">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2 pe-1">
                                                    <div class="avatar avatar-online">
                                                        <img src="../assets/img/avatars/1.png" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Admin</h6>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-cog-outline me-1 mdi-20px"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="ConfirmLogout()">
                                            <i class="mdi mdi-power me-1 mdi-20px"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>


                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->
