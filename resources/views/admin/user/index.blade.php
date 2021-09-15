@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">

    @include('admin.partials.content-header-user',['key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 border-bottom mb-2">
            {{-- <a href="{{route('user.create')}}" class="btn btn-outline-primary m-2">Thêm Người Dùng <i class="fas fa-user"></i></a> --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-user">
              Thêm Người Dùng <i class="fas fa-plus"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{route('user.store')}}" method="post">
                    @csrf
                  <div class="modal-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Tên người dùng</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Vai trò</label>
                            <select class="form-control" name="role" id="">
                                <option disabled selected>--Chọn vai trò--</option>
                                @foreach($list_role as $r)
                                <option  value="{{$r->name}}">{{$r->name}}</option>
                                @endforeach
                            </select>
                          </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <a href="{{ route('role.create') }}" class="btn btn-outline-primary m-2">Thêm vai trò mới <i class="fas fa-plus"></i></a>
          </div>
          @if (session('status'))
                <div class="alert alert-warning alert-dismissible fade show col-12" role="alert">
                  {{ session('status') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                {{-- <div class="alert alert-success col-12">
                    {{ session('status') }}
                </div> --}}
            @endif
          <div class="col-md-12">
              <div class="table-responsive-xl">
                <table class="table table-striped" id="PhanTrang">
                  <thead class="thead-dark">
                    <tr>
                      <th width="5%"  scope="col">#</th>
                      <th width="10%" scope="col">Tên </th>
                      <th width="10%" scope="col">Emai</th>
                      <th width="10%"  scope="col">Vai trò</th>
                      <th width="50%" scope="col">Quyền hạn</th>
                      <th width="5%" scope="col">Chức năng</th>


                    </tr>
                  </thead>
                  <tbody>
                    @foreach($list_user as $user)
                        <tr>
                          <th scope="row">{{$user->id}}</th>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>
                             @foreach($user->roles as $key => $role)
                             {{$role->name}}
                             @endforeach
                            </td>

                            <td>
                                @php
                                    $permission = $user->getPermissionsViaRoles();
                                @endphp
                                @foreach($permission as $per)
                                    <span class="badge badge-pill badge-info">{{$per->display_name}}</span>
                                @endforeach
                            </td>
                          <td class="d-flex align-items-center">

                            <a class="btn btn-outline-success btn-sm" title="trao quyền" href="{{route('user.edit', ['user' => $user->id ])}}"><i class="fas fa-user-tag"></i></a>

                            <a class="btn btn-outline-success btn-sm m-1" title="sửa quyền" href="{{route('user.show', ['user' => $user->id ])}}"><i class="fas fa-edit"></i></a>

                              <form action="{{ route('user.destroy', ['user' => $user->id ]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button title="xóa người dùng" onclick="return confirm('Bạn có chắc muốn xóa tài khoản người dùng này không ?');" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
            </div>
          </div>
          <div class="col-md-12">
            <div class="float-right">
                 {{-- {{ $categories->links() }} --}}
            </div>
            {{-- phân trang --}}

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection
@section('js')
<script>
    $('.user_li').addClass('menu-open');
    $('.user-list').addClass('active');
            $(document).ready(function(){
                $('#PhanTrang').DataTable({
                    'language': {
                        'sProcessing':   'Đang xử lý...',
                        'sLengthMenu':   'Hiển thị _MENU_ dòng',
                        'sZeroRecords':  'Không tìm thấy dòng nào phù hợp',
                        'sInfo':         'Đang xem _START_ đến _END_ trong tổng số _TOTAL_ dòng',
                        'sInfoEmpty':    'Đang xem 0 đến 0 trong tổng số 0 dòng',
                        'sInfoFiltered': '(được lọc từ _MAX_ dòng)',
                        'sInfoPostFix':  '',
                        'sSearch':       'Tìm kiếm:',
                        'sUrl':          '',
                        // 'oPaginate': {
                        //     'sFirst':    '<i class="fas fa-arrow-alt-to-left"></i>',
                        //     'sPrevious': '<i class="fas fa-arrow-alt-left"></i>',
                        //     'sNext':     '<i class="fas fa-arrow-alt-right"></i>',
                        //     'sLast':     '<i class="fas fa-arrow-alt-to-right"></i>'
                        // }

                    }
                });
            });
        </script>
@endsection
