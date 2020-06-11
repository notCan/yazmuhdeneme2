<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Giris</title>
        <link href="{{ URL::asset('backend/dist/css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">


                                                   @if (session('status') == "erorr")
                                                     <div class="alert alert-danger" role="alert">Kullanici Adi veya Sifre yanlis</div>
                                                   @endif
                                                   @if (session('status') == "succes")
                                                     <div class="alert alert-success" role="alert">Giris Basarili</div>
                                                   @endif


                                      <form action="{{route('adminLogin')}}" method="POST" methodclass="ml-auto mr-0 mr-md-3 my-2 my-md-0 text-center">
                                        @csrf
                                          <div class="input-group">
                                              <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Kullanici Adi</label>
                                              <input class="form-control p-4" style="width: 400px;" type="text" name="adminNick" placeholder="Admin Kullanici Adi" />
                                                </div>
                                              <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Sifre</label>
                                              <input class="form-control p-4" style="width: 400px;" type="text" name="adminPass" placeholder="Admin Sifre" />
                                                </div>
                                          </div>
                                          <div class="input-group-append">
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-4">
                                              <button class=" btn btn-primary" type="submit">Giris Yap</button>
                                              </div>
                                            </div>
                                      </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; MrAbraham 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ URL::asset('backend/dist/js/scripts.js') }}"></script>
    </body>
</html>
