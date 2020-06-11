@extends('backend.layout')
@section('content')
  <div id="layoutSidenav_content">
      <main>
          <div class="container-fluid">
              <h1 class="mt-4">Panel Post Sil</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active"></li>
              </ol>
              <form action="{{route('postsil')}}"method="POST" methodclass="ml-auto mr-0 mr-md-3 my-2 my-md-1 text-center">
                @csrf
                  <div class="input-group">
                      <input class="form-control" type="text" name="post-id" placeholder="Silmek istediginiz postid`yi girin..." aria-label="Search" aria-describedby="basic-addon2" />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Postu silmek istedginize emin misiniz ?')"><i class="fas fa-search"></i></button>
                        </div>
                  </div>
              </form>
              <br>

             @if (session('status') == "erorr")
               <div class="alert alert-danger" role="alert">Post silme islemi basarisiz</div>
             @endif
             @if (session('status') == "succes")
               <div class="alert alert-success" role="alert">Post basariyla silindi</div>
             @endif
             @if (session('status') == "warning")
               <div class="alert alert-warning" role="alert">Post bulunamadi</div>
             @endif

              <div class="card mb-4">
                  <div class="card-header"><i class="fas fa-table mr-1"></i>Postlar</div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                  <tr>
                                      <th>Post ID</th>
                                      <th>Kullanici ID</th>
                                      <th>Katagori ID</th>
                                      <th>POST</th>
                                  </tr>
                              </thead>
                              @foreach ($posts as $post)
                              <tbody>
                                  <tr>
                                      <td>{{$post['postid']}}</td>
                                      <td>{{$post['catid']}}</td>
                                      <td>{{$post['userid']}}</td>
                                      <td style="display: -webkit-box;
                                      -webkit-line-clamp: 1;
                                      -webkit-box-orient: vertical;
                                      overflow:hidden;
                                      padding: 0.55rem;"
                                      >{{$post['posttext']}}</td>
                                  </tr>
                              </tbody>
                              @endforeach
                          </table>
                      </div>
                  </div>
              </div>
          </div>
@endsection
