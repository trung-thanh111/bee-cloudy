<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title mb-0 text-uppercase">Chi tiết đơn hàng</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Danh sách</a>
                                    </li>
                                    <li class="breadcrumb-item active">Chi tiết</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                @include('backend.order.component.detail')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
