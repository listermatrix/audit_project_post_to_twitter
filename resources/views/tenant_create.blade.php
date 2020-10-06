
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #636b6f; color: white">Default Page</div>
                    <div class="card-body">
                        <form method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="username" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="" value="">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="" value="">
                                </div>
                            </div>
                        
                            <div class="form-group row mb-0 text-center ">
                                <div class="col-md-8 offset-2">
                                    <button type="submit" class="btn" style="background-color: #007E33; color: white">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <br>