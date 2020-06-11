@extends('backend.layout')
@section('content')
  <div id="layoutSidenav_content">
      <main>
          <div class="container-fluid">
              <h1 class="mt-4">Panel Anasayfa</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Hizli Islemler</li>
              </ol>

              <div class="row">
                {{-- <form method="POST" action="api/product">
                    @csrf
                    <button type="submit" class="btn btn-primary">Favorite</button>
                </form> --}}

                {{-- @foreach ($products as $deneme)
                  <li>{{ $deneme }}</li>
                @endforeach --}}
                  <div class="col-xl-3 col-md-6">
                      <div class="card bg-warning text-white mb-4">
                          <div class="card-body">Post Sil</div>
                          <div class="card-footer d-flex align-items-center justify-content-between">
                              <a class="small text-white stretched-link" href="{{ url("adminpanel/postsil/")}}">Detaylari Goruntule</a>
                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                      <div class="card bg-success text-white mb-4">
                          <div class="card-body">Kategori Onayla</div>
                          <div class="card-footer d-flex align-items-center justify-content-between">
                              <a class="small text-white stretched-link" href="{{ url("adminpanel/kategorionayla/")}}">Detaylari Goruntule</a>
                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                      <div class="card bg-danger text-white mb-4">
                          <div class="card-body">Kullanici Sil</div>
                          <div class="card-footer d-flex align-items-center justify-content-between">
                              <a class="small text-white stretched-link" href="{{ url("adminpanel/kullaniciengelle/")}}">Detaylari Goruntule</a>
                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                          </div>
                      </div>
                  </div>
              </div>


@endsection
