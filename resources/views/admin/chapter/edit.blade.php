@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cập nhật : <span class="text-primary">{{$chapter->name_chapter}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('post.index')}}"></a></li>
              <li class="breadcrumb-item active">Cập nhật</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

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
        <div class="card p-3">


            <form action="{{route('chapter.update',['chapter'=>$chapter->id])}}" method="post">
                {{-- cần phải có để gửi form --}}
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label >Tên chương</label>
                  <input type="text" value="{{$chapter->name_chapter}}" name="name_chapter" class="form-control" placeholder="Nhập tên thể loại" required>
                  <input type="text" value="{{$chapter->post_id}}" name="post_id" class="form-control" hidden>
                </div>
                <div class="form-group">
                  <label >Nội dung</label>
                  <textarea required name="content_chapter" class="form-control">
                    {{$chapter->content_chapter}}
                  </textarea>
                </div>
              <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection
@section('js')
<script>
   CKEDITOR.replace( 'content_chapter' );
</script>
@endsection

