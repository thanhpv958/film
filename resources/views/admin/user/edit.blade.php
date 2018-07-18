@extends('admin.layout.index')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm phòng chiếu mới</h3>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="panel-body">
        <form action="admin/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" value="{{$user->name}}" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="{{$user->email}}" name="email" required>
            </div>
            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" class="form-control" placeholder="Ảnh" name="image">
                <img src="fileupload/{{$user->image}}" width="30%">
                <input type="hidden" name="old_image" value="{{$user->image}}">
            </div>
            <div class="form-group">
                <label>Ngày sinh</label>
                <input type="text" class="form-control" value="{{$user->birthday}}" name="birthday" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu" required>
            </div>

                <div class="form-group">
                    <label>Vai trò</label>
                    <select class="form-control" name="role" {{((Auth::user()->role) == $user->role) ? 'disabled' : ''}}>
                        @foreach ($roles as $role)
                            <option value="{{$role->role}}" {{($role->role == $user->role) ? 'selected' : ''}}>
                                <?php
                                    if($role->role == 1) {
                                        echo 'Admin';
                                    }
                                    elseif ($role->role == 2) {
                                        echo 'Moderator';
                                    }
                                    else {
                                        echo 'User';
                                    }
                                ?>
                            </option>
                        @endforeach
                    </select>
                </div>

            <button type="submit" class="btn btn-primary" id="button">Sửa thông tin</button>
        </form>
    </div>
</div>
@endsection

