@extends('backend.layout')
@section('content')
  <div id="layoutSidenav_content">
      <main>
          <div class="container-fluid">
              <h1 class="mt-4">Panel Kategori Onayla</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active"></li>
              </ol>

              <br>

             @if (session('status') == "erorr")
               <div class="alert alert-danger" role="alert">Kategori onaylama basarisiz</div>
             @endif
             @if (session('status') == "succes")
               <div class="alert alert-success" role="alert">Kategori onaylama basarili</div>
             @endif

              <div class="card mb-4">
                  <div class="card-header"><i class="fas fa-table mr-1"></i>Kategori istekleri</div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">
                              <thead>
                                  <tr>
                                      <th>Kategori ID</th>
                                      <th>Kategori Baslik</th>
                                      <th>Kategori Text</th>
                                  </tr>
                              </thead>
                            @foreach ($categories as $cat)
                              <tbody>
                                  <tr>
                                      <td>{{$cat->catid}}</td>
                                      <td>{{$cat->cattitle}}</td>
                                      <td>{{$cat->cattext}}</td>
                                      <td width="1  "><form action="{{route('kategoriOnayla')}}"method="POST" methodclass="ml-auto mr-0 mr-md-3 my-2 my-md-1 text-center">
                                        @csrf
                                          <div class="input-group">
                                              <div class="input-group-append">
                                                <button class="btn btn-primary btn-success" type="submit" name="catid"value={{$cat->catid}} onclick="return confirm('Kategoriyi onaylamak istediginize emin misiniz ?')"><i class="fas fa-check"></i></button>
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
