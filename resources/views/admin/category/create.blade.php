@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    @include('admin.partials.content-header-category',['key' => 'Thêm danh mục'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @if (session('status'))
                <div class="alert alert-warning alert-dismissible fade show col-12" role="alert">
                  {{ session('status') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif
        <div class="card p-3 d-flex align-items-center">
          <div class="col-8">
            <form action="{{route('category.store')}}" method="post">
                {{-- cần phải có để gửi form --}}
                @csrf
                <div class="form-group">
                  <label >Tên danh mục</label>
                  <input type="text" name="name_category" class="form-control" placeholder="Nhập tên thể loại" required>
                </div>
                <div class="form-group">
                  <label >Mô tả</label>
                  <input type="text" name="decription" class="form-control" placeholder="Nhập mô tả">
                </div>
                <button type="submit" class="btn btn-outline-primary col">Thêm</button>
            </form>
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
    $('.category-add').addClass('active');
</script>
@endsection

