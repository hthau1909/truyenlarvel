@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('admin.partials.content-header-role',['key' => 'Thêm vai trò + Quyền'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{-- <div class="row"> --}}
          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="card">
            <div class="card-body">
                <form action="{{route('role.store')}}" method="POST">
            @csrf
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Vai trò</label>
                <div class="col-sm-6">
                  <input type="text" placeholder="Nhập tên vai trò" name="name" class="form-control" required>
                </div>
              </div>
              <fieldset class="form-group row">
                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Quyền Hạn</legend>
                <div class="col-sm-10">
                  @foreach($permissions as $per)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" id="per_{{$per->id}}" value="{{$per->name}}">
                    <label class="form-check-label" for="per_{{$per->id}}">
                      {{$per->display_name}}
                    </label>
                  </div>
                  @endforeach
                </div>
              </fieldset>
              <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
              </div>
            </form>
            </div>

        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection

