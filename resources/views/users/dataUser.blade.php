

<div class="card" style="width: 100%;">
    <div class="card-body">
    
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-name">{{ __('Nombre') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control" value="{{isset($user->name)?$user->name:old('name')}}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-name">{{ __('Correo') }}</label>
                        <input type="text" name="email" id="input-name" class="form-control" value="{{isset($user->email)?$user->email:old('email')}}" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 row justify-content-center mt-6">
                    <div class="col-lg-3 order-lg-2">

                        <div class="card-profile-image">
                            <img src="{{isset($user->photo)?asset('storage').'/'.$user->photo:''}}" class="rounded-circle" alt="No Foto">  
                        </div>

                    </div>
                </div>
                
            </div>
            
        </form>
    </div>
</div>
    
    
    