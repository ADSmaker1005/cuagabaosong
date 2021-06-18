<x-app-layout>
    <x-slot name="header">
            {{ __('Danh sách khách hàng') }}
    </x-slot>
    <div class="row text-center">
        <form class="form-group col-md-4" action="{{ route('admin.customer.import') }}" method="POSt" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label>Nhập dữ liệu</label>
            <input type="file" name="excel" style="width: 200px"> 
            <button type="submit" class="btn btn-success">Nhập</button>
        </form>
        <form class="col-md-4"> 
            <a href="{{ route('admin.customer.export') }}" class="btn btn-danger">Xuất dữ liệu</a>
        </form>
        <div class="col-md-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tạo khách hàng
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form class="row mb-3" action="{{ route('admin.customer.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group col-md-6">
                                <label>Tên khách hàng</label>
                                <input class="form-control" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Số điện thoại</label>
                                <input class="form-control" name="call">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="bill">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Đơn hàng</label>
                                <input class="form-control" name="address">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ghi chú</label>
                                <input class="form-control" name="note">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ngày nhận hàng</label>
                                <input class="form-control" type="date" name="date_receive">
                            </div>
                            <div class="text-center col-md-12">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2 text-center text-danger">
        <b>Tìm kiếm khách hàng</b>
    </div>
    <form action="">
        <div class="form-group">
            <label>Theo số điện thoại</label>
            <input name="search_phone" type="number" class="form-control">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Tìm kiếm</button>
        </div>
    </form>
    
    <div style="overflow: auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        Tên khách hàng
                    </th>
                    <th>
                        Số điện thoại
                    </th>
                    <th>
                        Địa chỉ
                    </th>
                    <th>
                        Đơn hàng
                    </th>
                    <th>
                        Ghi chú
                    </th>
                    <th>
                        Ngày nhận hàng
                    </th>
                    <th>
                        Nơi biết khách
                    </th>
                    <th>
                        Trạng thái (excel)
                    </th>
                    <th>
                        Trạng thái
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>
                            {{ $customer->name }}
                        </td>
                        <td>
                            {{ $customer->call }}
                        </td>
                        <th>
                            {{ $customer->address }}
                        </th>
                        <td>
                            {{ $customer->bill }}
                        </td>
                        <td>
                            {{ $customer->note }}
                        </td>
                        <td>
                            {{ $customer->date_receive }}
                        </td>
                        <td>
                            {{ $customer->source }}
                        </td>
                        <td>
                            {{ $customer->status_string }}
                        </td>
                        <td>
                            <form action="{{ route('admin.customer.update',$customer->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <select class="form-control" name="status" onchange="this.form.submit()">
                                    <option value="">Chọn</option>
                                    <option value="1" {{$customer->status ? ($customer->status == "1" ? "selected" : "") : ""}}>Đã gửi</option>
                                    <option value="2" {{$customer->status ? ($customer->status == "2" ? "selected" : "") : ""}}>Chuyển hoàn TC</option>
                                    <option value="3" {{$customer->status ? ($customer->status == "3" ? "selected" : "") : ""}}>Sổ đen</option>
                                    <option value="4" {{$customer->status ? ($customer->status == "3" ? "selected" : "") : ""}}>Phát thành công</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.customer.destroy',$customer->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{ $customers->links() }}
</x-app-layout>