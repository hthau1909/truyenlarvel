@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.content-header-user',['key' => 'Trao quyền'])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row mb-2">
            <a href="{{route('role.create')}}" class="btn btn-outline-primary">Tạo vai trò mới <i class="fas fa-plus"></i></a>
        </div>
        <div class="card row">
                <div class="card-header">{{ __('Vai trò hiện tại : ') }}{{$role_user}}</div>

                <div class="card-body">
                    <form action="{{route('updaterole',['id' => $user->id]) }}" method="post">
                      @method('POST')
                      @csrf
                      <div class="form-group">
                        <label>Vai trò sẵn có</label>
                        <select name="choose_role" class="form-control">
                          <option selected disabled class="form-control">--- Chọn vai trò ---</option>
                          @foreach($roles as $role)
                          @if($role->name == $role_user)
                            <option value="{{$role->name}}" class="form-control" selected>{{$role->name}}</option>
                            @else
                            <option value="{{$role->name}}" class="form-control" >{{$role->name}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                    </form>
                </div>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection
