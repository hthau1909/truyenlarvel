@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('admin.partials.content-header-genre',['key' => 'Danh sách'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-2">
            @if(auth()->user()->can('add genre'))
            <a href="{{route('genre.create')}}" class="btn btn-outline-primary"> <i class="fas fa-tag"></i> Thêm thể loại</a>
            @endif
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
          <div class="col-md-12 mt-2 card p-2">
              <div class="table-responsive-xl"  >
                <table class="table table-striped" id="PhanTrang" >
                  <thead class="thead-light">
                    <tr>
                      <th width="5%"  scope="col">#</th>
                      <th  scope="col">Tên thể loại </th>
                      <th  scope="col">Mô tả</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Chức năng</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($genres as $genre)
                    <tr>
                      <td>{{$genre->id}}</td>
                      <td>{{$genre->name_genre}}</td>
                      <td>{{$genre->decription}}</td>
                      <td>{{$genre->slug_genre}}</td>
                      <td class="d-flex align-items-center">
                        @if(auth()->user()->can('edit genre'))
                        <a class="btn btn-outline-warning btn-sm m-1" title="sửa {{$genre->name}}" href="{{route('genre.show', ['genre' => $genre->id ])}}"><i class="fas fa-edit"></i></a>
                        @endif
                        @if(auth()->user()->can('delete genre'))
                          <form action="{{ route('genre.destroy', ['genre' => $genre->id ]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn có chắc muốn xóa thể loại truyện này không ?');" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                        @endif
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
                        'sUrl':          ''

                    }
                });
            });
        </script>
@endsection


