@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    @include('admin.partials.content-header-post',['key' => 'Sửa truyện'])

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
            <form action="{{route('post.update',['post'=>$post->id])}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <div class="col">
                        <label >Tên Truyện <span class="text-danger">*</span></label>
                        <input type="text" value="{{$post->name_post}}" class="form-control" placeholder="Nhập tên anime ..." name="name_post" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label >Tác Giả</label>
                        <input type="text" value="{{$post->author}}" class="form-control" placeholder="Nhập tên khác ..." name="author">
                    </div>
                </div>
                <div class="form-group row p-2">
                    {{-- <div class="form-row"> --}}
                     <div class="col">
                        <label >Trạng thái <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" id="" required>
                           <option disabled selected>-- Chọn trạng thái --</option>

                            <option value="0" @if($post->status == 0) selected @endif>Đang Cập Nhật</option>
                            <option value="1" @if($post->status == 1) selected @endif>Đã Hoàn Thành</option>
                        </select>

                    </div>
                    @if(auth()->user()->can('publish post'))
                    <div class="col">
                        <label >Kích Hoạt Truyện <span class="text-danger">*</span></label>
                        <select name="active" class="form-control" id="">
                            <option disabled selected>-- Chọn trạng thái --</option>
                            <option value="1" @if($post->active == 1) selected @endif>Kích Hoạt</option>
                            <option value="0" @if($post->active == 0) selected @endif>Không Kích Hoạt</option>
                        </select>
                    </div>
                    @else
                    <select name="active" class="form-control" id="" hidden>
                            <option disabled selected>-- Chọn trạng thái --</option>
                            <option value="1" @if($post->active == 1) selected @endif>Kích Hoạt</option>
                            <option value="0" @if($post->active == 0) selected @endif>Không Kích Hoạt</option>
                        </select>
                    @endif
                    {{-- </div> --}}
                </div>
                <div class="form-group row p-2">
                    <div class="col">
                        <label >Thể Loại Truyện<span class="text-danger">*</span></label>
                        <br>
                        @foreach($genres as $genre)

                        <div class="form-check form-check-inline mt-2 col-2">
                          <input class="form-check-input"
                          @if($genrePost->contains($genre->id))
                          checked
                          @endif
                           type="checkbox" name="genre[]" id="genre_{{$genre->id}}" value="{{$genre->id}}">
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
                          <input class="form-check-input"
                           @if($categoryPost->contains($category->id))
                          checked
                          @endif
                          type="checkbox" name="category[]" id="category_{{$category->id}}"  value="{{$category->id}}">
                          <label class="form-check-label" for="category_{{$category->id}}">{{$category->name_category}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row pl-2 pr-2">
                    <div class="col-8" >
                        <label >Ảnh Bìa Truyện<span class="text-danger">*</span></label>
                        <input name="image" class="form-control" type="file" accept="image/*" onchange="loadImg(event)">

                        <label class="mt-1">Nội dung <span class="text-danger">*</span></label>
                        <textarea required name="content" class="form-control" rows="8" style="resize: none;">
                        {{$post->content_post}}
                        </textarea>


                    </div>
                    <div class="col-4 mt-4" >
                        <img height="280px" src="{{asset('image/'.$post->image)}}" width="100%" alt="" id="outputImg">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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

