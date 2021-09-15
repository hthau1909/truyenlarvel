@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection
@section('content')
  <div class="content-wrapper">
    @include('admin.partials.content-header-genre',['key' => 'Sửa thể loại'])

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
        <div class="card d-flex align-items-center p-3">
          <div class="col-8">

            <form action="{{route('genre.update',['genre'=> $genre->id])}}" method="post">
                {{-- cần phải có để gửi form --}}
                 @method('PUT')
                @csrf
                <div class="form-group">
                  <label >Tên thể loại</label>
                  <input value="{{$genre->name_genre}}" type="text" name="name_genre" class="form-control" placeholder="Nhập tên thể loại" required>
                </div>
                <div class="form-group">
                  <label >Mô tả</label>
                  <input type="text" value="{{$genre->decription}}" name="decription" class="form-control" placeholder="Nhập tên thể loại" required>
                </div>
              <button type="submit" class="btn btn-warning">Cập nhật</button>
            </form>
          </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection


