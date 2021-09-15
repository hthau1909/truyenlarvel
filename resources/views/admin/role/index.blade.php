@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('admin.partials.content-header-role',['key' => 'Danh sách'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 ">
            <a href="{{ route('role.create') }}" class="btn btn-outline-primary m-2">Add New Role <i class="fas fa-plus"></i></a>
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
                      <th width="5%" scope="col">#</th>
                      <th width="20%" scope="col">Vai trò</th>
                      <th width="55%" scope="col">Quyền hạn</th>
                      <th width="20%" scope="col">Chức năng</th>
                      {{-- <th width="5%" scope="col">Xóa</th> --}}

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $role)

                    <tr>
                      <th scope="row">{{ $role->id}}</th>
                      <td>{{ $role->name}}</td>
                      <td>
                        @foreach($role->permissions as $per)
                          <span class="badge badge-pill badge-dark">{{$per->name}}</span>
                        @endforeach
                      </td>
                      <td class="d-flex align-items-center">
                        <a href="{{ route('role.edit',['role' => $role->name]) }}" class="btn btn-outline-warning btn-sm m-1" title="Sửa vai trò {{$role->name}}"><i class="fas fa-edit"></i></a>
                        {{-- <a href="{{ route('role.destroy',['role' => $role->name]) }}" class="btn btn-danger">Xóa</a> --}}

                        <form action="{{ route('role.destroy', ['role' => $role->id ]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button title="Xóa vai trò {{$role->name}}" onclick="return confirm('Bạn có chắc chắn muốn xóa vai trò này không, Việc này sẽ ảnh hưởng đến các user có vai trò này !!! ?');" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
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
    $('.user-role').addClass('active');
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
