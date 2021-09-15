@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    @include('admin.partials.content-header-post',['key' => 'Thêm truyện'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
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
            <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                {{-- cần phải có để gửi form --}}
                @csrf
                <div class="form-group">
                    <div class="col">
                        <label >Tên Truyện <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nhập tên truyện ..." name="name_post" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label >Tác Giả</label>
                        <input type="text" class="form-control" placeholder="Nhập tên tác giả ..." name="author">
                    </div>
                </div>
                <div class="form-group row p-2">
                    {{-- <div class="form-row"> --}}
                     <div class="col">
                        <label >Trạng thái <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" id="" required>
                           <option disabled selected>-- Chọn trạng thái --</option>
                            <option value="0">Đang Cập Nhật</option>
                            <option value="1">Đã Hoàn Thành</option>
                        </select>

                    </div>
                    @if(auth()->user()->can('publish post'))
                    <div class="col">
                        <label >Kích Hoạt Truyện <span class="text-danger">*</span></label>
                        <select name="active" class="form-control" id="" required>
                            <option disabled selected>-- Chọn trạng thái --</option>
                            <option value="1">Kích Hoạt</option>
                            <option value="0">Không Kích Hoạt</option>
                        </select>
                    </div>
                    @endif
                    {{-- </div> --}}
                </div>
                <div class="form-group row p-2">
                    <div class="col">
                        <label >Thể Loại Truyện<span class="text-danger">*</span></label>
                        <br>
                        @foreach($genres as $genre)

                        <div class="form-check form-check-inline mt-2 col-2">
                          <input class="form-check-input" type="checkbox" name="genre[]" id="genre_{{$genre->id}}" value="{{$genre->id}}">
                          <label class="form-check-label" for="genre_{{$genre->id}}">{{$genre->name_genre}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row p-2">
                    <div class="col">
                        <label >Danh Mục Truyện<span class="text-danger">*</span></label>
                        <br>
                        @foreach($categories as $category)

                        <div class="form-check form-check-inline mt-2 col-2">
                          <input class="form-check-input" type="checkbox" name="category[]" id="category_{{$category->id}}"  value="{{$category->id}}">
                          <label class="form-check-label" for="category_{{$category->id}}">{{$category->name_category}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row pl-2 pr-2">
                    <div class="col-8" >
                        <label >Ảnh Bìa Truyện<span class="text-danger">*</span></label>
                        <input required name="image" class="form-control" type="file" accept="image/*" onchange="loadImg(event)">

                        <label class="mt-1">Nội dung <span class="text-danger">*</span></label>
                        <textarea required name="content" class="form-control" rows="8" style="resize: none;">

                        </textarea>


                    </div>
                    <div class="col-4 mt-4" >
                        <img height="280px" width="100%" alt="" id="outputImg">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>

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
    var loadImg = function(event) {
        var outputImg = document.getElementById('outputImg');
        outputImg.src = URL.createObjectURL(event.target.files[0]);
      };
      CKEDITOR.replace('content');
</script>
@endsection

