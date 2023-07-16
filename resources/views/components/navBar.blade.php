@section('navbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light p-4">
  <div class="container">
    <a class="navbar-brand" href="#">Store</a>
    <button class="navbar-toggler" type="button">
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      @if(Auth::check() && Auth::user()->is_admin ==1)
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{URL('/d_user')}}">All useres</a>
        </li>
        <li class="nav-item">

          <a class="nav-link" href="{{URL('/d_user/create')}}">Add new User</a>
        </li>
      </ul>
      @endif
      <ul class="navbar-nav ml-auto">
        @if(Auth::check())
        <li class="nav-item">
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('d_user/logout')}}">Log Out</a>
        </li>
        @else
        <li class="nav-item">
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('d_user/login')}}">Log in</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('d_user/create')}}">sign up</a>
        </li>
        @endif
      </ul>
      

    </div>
  </div>
</nav>


@endsection