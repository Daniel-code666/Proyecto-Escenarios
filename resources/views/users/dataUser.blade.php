

<div class="card" style="width: 100%;">
    <div class="card-body">
    
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <label class="form-control-label" for="input-name">{{ __('Nombre') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-name">{{ __('Correo') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control" value="">
                    </div>
                </div>
                <div class="col-3 row justify-content-center mt-6">
                    <div class="col-lg-3 order-lg-2">

                        <div class="card-profile-image">
                            <img src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" class="rounded-circle">  
                        </div>

                    </div>
                </div>
                
            </div>
            
        </form>
    </div>
</div>
    
    
    