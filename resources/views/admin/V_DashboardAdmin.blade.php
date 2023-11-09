@include('admin/components/layouts/V_Header')
@include('admin/components/layouts/V_Sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 p-3 d-flex justify-content-center">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" width="60%"
                            alt="">
                    </div>
                    <div class="col-12 col-lg-8 p-4 justify-content-around">
                        <h4>Welcome Back</h4>
                        <h3 class="text-primary">Finance Infly Networks!</h3>
                        <h5>Website untuk management keuangan pada infly networks</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="layout-demo-wrapper">
            <div class="layout-demo-placeholder">
                <img src="../assets/img/layouts/layout-container-light.png" class="img-fluid" alt="Layout container"
                    data-app-light-img="layouts/layout-container-light.png"
                    data-app-dark-img="layouts/layout-container-dark.png" />
            </div>
            <div class="layout-demo-info">
                <h4>Layout container</h4>
                <p>Container layout sets a <code>max-width</code> at each responsive breakpoint.</p>
            </div>
        </div> --}}

    </div>
    <!-- / Content -->

    @include('admin/components/layouts/V_Footer')
