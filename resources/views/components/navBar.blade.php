@section('content')
<div class="row">
  <nav class="navbar navbar-expand navbar-light bg-light p-4">
    <a class="navbar-brand" href="#">Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      @isset($user)
          @if($user->is_admin ==1)
        <li class="nav-item active">
          <a class="nav-link" href="{{URL('/d_user')}}">All useres</a>
        </li>
        <li class="nav-item">
         
          <a class="nav-link" href="{{URL('/d_user/register')}}">Add new User</a>
          @endif
          @endisset
        </li>
        <div class="inline my-2 my-lg-0">
          @isset($user)
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('d_user/logout')}}">Log Out</a>
          @else
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('d_user/login')}}">Log in</a>
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('d_user/register')}}">sign up</a>
          @endisset
        </div>

      </ul>

    </div>
  </nav>
</div>

@endsection