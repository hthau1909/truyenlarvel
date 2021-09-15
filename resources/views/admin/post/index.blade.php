@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('admin.partials.content-header-post',['key' => 'Danh sách'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-2">
            @if(auth()->user()->can('add post'))
            <a href="{{route('post.create')}}" class="btn btn-outline-primary"> <i class="fas fa-tag"></i> Thêm Truyện</a>
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
          <div class="col-md-12 mt-2 card p-3">
              <div class="table-responsive-xl"  >
                <table class="table table-striped" id="PhanTrang" >
                  <thead class="thead-light">
                    <tr>
                      <th width="5%"  scope="col">#</th>
                      <th  scope="col">Tên Truyện</th>
                      <th  scope="col">Ảnh truyện</th>
                      <th  scope="col">Thể loại</th>
                      <th  scope="col">Danh mục truyện</th>
                      <th scope="col">Số chương</th>
                      <th width="5%" scope="col">Kích hoạt truyện</th>
                      <th scope="col">Chức năng</th>
                      {{-- <th width="5%" scope="col">Xóa</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($posts as $post)
                    <tr>
                      <td>{{$post->id}}</td>
                      <td>{{$post->name_post}}</td>
                      <td><img style="width: 50px;" src="{{asset('image/'.$post->image)}}" alt=""></td>
                      <td>
                        @foreach($post->postGenre as $genre)
                        <span class="badge badge-pill badge-dark">{{$genre->name_genre}}</span>
                        @endforeach
                      </td>
                      <td>
                            @foreach($post->postCategory as $category)
                            <span class="badge badge-pill badge-dark">{{$category->name_category}}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($post->status ==0)
                             {{$post->chapter->count()}}/không rõ
                            @else
                            {{$post->chapter->count()}}/{{$post->chapter->count()}}
                            @endif
                        </td>

                      <td>
                        @if(auth()->user()->can('publish post') || auth()->user()->hasRole('admin'))
                        @if($post->active == 0)
                            <form action="{{ route('publishpost', ['id' => $post->id ]) }}" method="post">
                                @method('POST')
                                @csrf
                                <input type="text" value="1" name="active" hidden>

                                <button type="submit" onclick="return confirm('Kích hoạt truyện này {{$post->name_post}} ?');" class="badge badge-pill badge-danger" title="nhấn để kích hoạt truyện">Chưa kích hoạt</button>
                            </form>
                        @else
                            <form action="{{ route('publishpost', ['id' => $post->id ]) }}" method="post">
                                @method('POST')
                                @csrf
                                <input type="text" value="0" name="active" hidden>

                                <button type="submit" onclick="return confirm('Hủy kích hoạt truyện {{$post->name_post}} ?');" class="badge badge-pill badge-success" title="nhấn để hủy kích hoạt">Đã kích hoạt</button>
                            </form>
                        @endif

                        @else
                            @if($post->active == 0)
                                <span class="badge badge-pill badge-danger">Truyện của bạn chưa được duyệt</span>
                            @else
                                <span class="badge badge-pill badge-success">Truyện của bạn đã được duyệt</span>
                            @endif
                        @endif
                      </td>

                      <td class="d-flex align-items-center">
                        @if(auth()->user()->can('add chapter'))
                        <a class="btn btn-outline-secondary btn-sm m-1" title="nhấn để thêm chương mới cho truyện {{$post->name_post}}" href="{{route('createchapter',['id'=>$post->id])}}"><i class="fas fa-feather-alt"></i></a>
                        {{-- them tap --}}
                        @endif
                        @if(auth()->user()->can('browse chapter'))
                        <a href="{{route('chapter.show',['chapter'=>$post->id])}}" title="nhấn để xem danh sách chương của truyện {{$post->name_post}}" class="btn btn-primary btn-sm "><i class="fas fa-list"></i></a>
                        {{-- end --}}
                        @endif
                        {{-- edit --}}
                        @if(auth()->user()->can('edit post'))
                        <a class="btn btn-outline-warning btn-sm m-1" title="sửa {{$post->name_post}}" href="{{route('post.edit', ['post' => $post->id ])}}"><i class="fas fa-edit"></i></a>
                        {{-- end --}}
                        {{-- delete --}}
                        @endif
                        @if(auth()->user()->can('delete post'))
                          <form action="{{ route('post.destroy', ['post' => $post->id ]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn có chắc muốn xóa danh mục truyện này không ?');" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                        @endif
                        {{-- end --}}
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
<script>

@endsection


