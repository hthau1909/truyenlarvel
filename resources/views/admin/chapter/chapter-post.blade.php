@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Danh sách chương :<span class="text-primary">{{$post->name_post}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('post.index')}}">Danh sách</a></li>
              <li class="breadcrumb-item active">{{$post->name_post}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-2">
            @if(auth()->user()->can('add chapter'))
            <a href="{{route('createchapter',['id'=>$post->id])}}" class="btn btn-outline-primary"> <i class="fas fa-plus"></i> Thêm chương mới</a>
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
          <div class="col-md-12 mt-2">
              <div class="table-responsive-xl"  >
                <table class="table table-striped" id="PhanTrang" >
                  <thead class="thead-light">
                    <tr>
                      <th width="5%"  scope="col">#</th>
                      <th  scope="col">Tên chương</th>
                      <th  scope="col">Nội dung</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Chức năng</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($list_chap as $chapter)
                    <tr>
                      <td>{{$stt++}}</td>
                      <td>{{$chapter->name_chapter}}</td>
                      <td>{!!$chapter->content_chapter!!}</td>
                      <td>{{$chapter->slug_chapter}}</td>
                      <td class="d-flex align-items-center">
                        @if(auth()->user()->can('edit chapter'))
                        <a class="btn btn-outline-warning btn-sm m-1" title="sửa {{$chapter->name_chapter}}" href="{{route('chapter.edit', ['chapter' => $chapter->id ])}}"><i class="fas fa-edit"></i></a>
                        @endif
                        @if(auth()->user()->can('delete chapter'))
                          <form action="{{ route('chapter.destroy', ['chapter' => $chapter->id ]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn có chắc muốn xóa chương truyện này không ?');" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
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


