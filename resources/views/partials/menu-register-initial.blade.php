<div class="menu w-100">
  <div class="menu-container">
    <div class="row">
      <div class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('provider.register') }}"><img src="{{ url('/images/logo.png') }}"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">

        </div>
      </nav>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="errors-register" value="{{count($errors->get('email-register')) == 0 ? '':'1'}}">
<input type="hidden" id="errors-login" value="{{$errors->has('email') ? '1':''}}">

<div class="modal fade login" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bigModal">
      <div class="modal-body login">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="col-md-12">
          <div class="row login">
            <div class="col-md-6 l-margin">
              <h3 class="text-center pb-4">Iniciar sesión</h3>

              @include('auth/login')

            </div>
            <div class="col-md-6 r-margin">
              <h3 class="text-center pb-4">Registrarse</h3>

              @include('auth/register')

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>