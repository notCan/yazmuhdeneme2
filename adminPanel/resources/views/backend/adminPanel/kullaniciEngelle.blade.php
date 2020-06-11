@extends('backend.layout')
@section('content')
  <div id="layoutSidenav_content">
      <main>
          <div class="container-fluid">
              <h1 class="mt-4">Panel Kategori Onayla</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active"></li>
              </ol>
              <form action="{{route('kgetir')}}" method="POST" methodclass="ml-auto mr-0 mr-md-3 my-2 my-md-0 text-center">
                @csrf
                  <div class="input-group">
                      <input class="form-control" type="text" name="userName" placeholder="Engelleme istediginiz kullanici ismini girin..." aria-label="Search" aria-describedby="basic-addon2" />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                  </div>
              </form>

              <br>


             @if (session('status') == "erorr")
               <div class="alert alert-danger" role="alert">Kullanici engellenme basarisiz</div>
             @endif
             @if (session('status') == "succes")
               <div class="alert alert-success" role="alert">Kullanici basariyla engellendi</div>
             @endif
             @if (session('status') == "warning")
               <div class="alert alert-warning" role="alert">Kullanici bulunamadi</div>
             @endif

              <div class="card mb-4">
                  <div class="card-header"><i class="fas fa-table mr-1"></i>Kullanici Bilgi</div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">
                              <thead>
                                  <tr>
                                      <th>Kullanici ID</th>
                                      <th>Kullanici Ismi</th>
                                      <th>Kullanici e-mail</th>
                                  </tr>
                              </thead>
                             @foreach ($users as $user)
                              <tbody>
                                  <tr>
                                      <td>{{$user->userid}}</td>
                                      <td>{{$user->userNick}}</td>
                                      <td>{{$user->userMail}}</td>
                                       <td width='10'><form action="{{route('kullaniciEngelle')}}"method="POST" methodclass="ml-auto mr-0 mr-md-3 my-2 my-md-1 text-center">
                                        @csrf
                                          <div class="input-group">
                                              <div class="input-group-append">
                                                <button class="btn btn-primary btn-success" type="submit" name="userid"value={{$user->userid}} onclick="return confirm('Kullaniciyi engellemek istediginize emin misiniz ?')"><i class="fas fa-check"></i></button>
                                                </div>
                                          </div>
                                      </form></td>
                                  </tr>
                              </tbody>
                              @endforeach
                          </table>
                      </div>
                  </div>
              </div>
          </div>
@endsection
