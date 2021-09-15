@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('admin.partials.content-header-category',['key' => 'Danh sách'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-2">
            @if(auth()->user()->can('add category'))
            <a href="{{route('category.create')}}" class="btn btn-outline-primary"> <i class="fas fa-plus"></i> Thêm Danh Mục</a>
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
                      <th  scope="col">Tên danh mục </th>
                      <th  scope="col">Mô tả</th>
                      <th scope="col">Slug</th>
                      <th width="15%" scope="col">Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                    <tr>
                      <td>{{$category->id}}</td>
                      <td>{{$category->name_category}}</td>
                      <td>{{$category->decription}}</td>
                      <td>{{$category->slug_category}}</td>
                      <td class="d-flex align-items-center">
                        @if(auth()->user()->can('edit category'))
                        <a class="btn btn-outline-warning btn-sm mr-1" title="sửa {{$category->name_category}}" href="{{route('category.edit', ['category' => $category->id ])}}"><i class="fas fa-edit"></i></a>
                        @endif
                        @if(auth()->user()->can('delete category'))
                          <form action="{{ route('category.destroy', ['category' => $category->id ]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn có chắc muốn xóa danh mục truyện này không ?');" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
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
    $('.category_li').addClass('menu-open');
    $('.category-list').addClass('active');
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


