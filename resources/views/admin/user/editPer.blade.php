@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('admin.partials.content-header-user',['key' => 'Cập nhật quyền'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
         <div class="card">

                <div class="card-header">
                    <strong>Tài khoản : </strong> {{$user->email}}
                    <strong>| Tên người dùng :</strong> {{$user->name}}
                    <strong>| Vai trò hiện tại :</strong>{{$role_user}}</div>
                <div class="card-body">
                    <h6>Quyền hạn</h6>
                    <form action="{{route('user.update',['user'=>$user->id])}}" method="post">
                      @method('PUT')
                      @csrf
                        <div class="form-group row">
                          @foreach($permissions as $per)
                          <div class="form-check col-3">
                            <input class="form-check-input"
                            @foreach($permission_user as $pu)
                              @if($pu->id == $per->id)
                              checked
                              @endif
                            @endforeach
                             type="checkbox" name="permission[]" id="{{$per->id}}" value="{{$per->name}}">
                            <label class="form-check-label" for="{{$per->id}}">
                              {{$per->display_name}}
                            </label>
                          </div>
                          @endforeach
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


