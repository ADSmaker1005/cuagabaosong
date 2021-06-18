<x-app-layout>
    <x-slot name="header">
            {{ __('Người dùng phân quyền') }}
    </x-slot>
    <form class="row mb-3" action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group col-md-4">
            <label>Tên người dùng</label>
            <input class="form-control" name="name">
        </div>
        <div class="form-group col-md-4">
            <label>Email</label>a
            <input class="form-control" type="email" name="email">
        </div>
        <div class="form-group col-md-4">
            <label>Mật khẩu</label>
            <input class="form-control" type="password" name="password">
        </div>
        <div class="text-center col-md-12">
            <button type="submit" class="btn btn-success">Lưu</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    Email
                </th>
                <th>
                    Tên
                </th>
                <th>
                    Quyền hạn
                </th>
                <th>
                    Thao tác
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        <form action="{{ route('admin.user.update',$user->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <select class="form-control" name="role" onchange="this.form.submit()">
                                <option value="">Chọn</option>
                                <option value="1" {{ $user->Role->first() != null ? ($user->Role->first()->role_id == "1" ? "selected" : "") : ""}}>Admin quản trị</option>
                                <option value="2" {{ $user->Role->first() != null ? ($user->Role->first()->role_id == "2" ? "selected" : "") : ""}}>Người làm nội dung</option>
                                <option value="3" {{ $user->Role->first() != null ? ($user->Role->first()->role_id == "3" ? "selected" : "") : ""}}>Nhân viên</option>
                                <option value="4" {{ $user->Role->first() != null ? ($user->Role->first()->role_id == "4" ? "selected" : "") : ""}}>Đại lý</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.user.destroy',$user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</x-app-layout>