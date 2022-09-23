<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center fondo" >

    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <br>
                <h1 class="display-2 text-white text-center">{{ $title }}</h1>
                @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-3">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div> 

<style>
.fondo{
    background-color: #000000;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg %3E%3Cpolygon fill='%2311091b' points='1600 160 0 460 0 350 1600 50'/%3E%3Cpolygon fill='%23221236' points='1600 260 0 560 0 450 1600 150'/%3E%3Cpolygon fill='%23321a50' points='1600 360 0 660 0 550 1600 250'/%3E%3Cpolygon fill='%2343236b' points='1600 460 0 760 0 650 1600 350'/%3E%3Cpolygon fill='%23542C86' points='1600 800 0 800 0 750 1600 450'/%3E%3C/g%3E%3C/svg%3E");
    background-attachment: fixed;
    background-size: cover;
    }
</style>