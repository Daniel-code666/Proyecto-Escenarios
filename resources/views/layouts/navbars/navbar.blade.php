@guest()
    @include('layouts.navbars.navs.guest')
@endguest

@auth()
    @if(auth()->user()->role_idrole == 3)
        @include('layouts.navbars.navs.userNav')
    @elseif(auth()->user()->role_idrole == 1 || auth()->user()->role_idrole == 2)
        @auth()
            @include('layouts.navbars.navs.auth')
        @endauth
    @endif
@endauth



    
