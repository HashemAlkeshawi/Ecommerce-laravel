@section('navbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light p-4">
  <div class="container">
    <a class="navbar-brand" href="{{URL('/')}}">Store</a>
    <button class="navbar-toggler" type="button">
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      @if(Auth::check() && Auth::user()->isAdmin())
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            User
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li class="nav-item">
              <a class="dropdown-item" href="{{URL('/user')}}">All Useres</a>
            </li>
            <li class="nav-item">

              <a class="dropdown-item" href="{{URL('/user/create')}}">Add new User</a>
            </li>

          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vendor
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li class="nav-item">
              <a class="dropdown-item" href="{{URL('/vendor')}}">All Vendors</a>
            </li>
            <li class="nav-item">

              <a class="dropdown-item" href="{{URL('/vendor/create')}}">Add new Vendor</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Brand
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li class="nav-item">
              <a class="dropdown-item" href="{{URL('/brand')}}">All Brands</a>
            </li>
            <li class="nav-item">

              <a class="dropdown-item" href="{{URL('/brand/create')}}">Add new Brand</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Item
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li class="nav-item">
              <a class="dropdown-item" href="{{URL('/item')}}">All Items</a>
            </li>
            <li class="nav-item">

              <a class="dropdown-item" href="{{URL('/item/create')}}">Add new Item</a>
            </li>
          </ul>
        </li>


      </ul>
      @else
      <ul class=" navbar-nav mr-auto">

        <li class="nav-item">
          <a class="btn btn-outline" href="{{URL('/brand')}}">Brands</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline" href="{{URL('/item')}}">Items</a>
        </li>


      </ul>

      @endif
      <ul class="navbar-nav ml-auto">
        @if(Auth::check())
        <li class="nav-item">
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('user/logout')}}">Log Out</a>
        </li>
        @else
        <li class="nav-item">
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('user/login')}}">Log in</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success my-2 my-sm-0" href="{{URL('user/create')}}">sign up</a>
        </li>
        @endif
      </ul>


    </div>
  </div>
</nav>


@endsection