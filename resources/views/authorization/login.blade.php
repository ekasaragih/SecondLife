<head>
    <link rel="stylesheet" href="/argon/assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body class="bg-white">
    {{-- <main class="main-content">
        <div class="container">
            <div class="row mt-lg-5 justify-content-center align-items-center mx-auto">
                <div class="col-xl-4 col-lg-5 ml-md-5">
                    <div class="card z-index-0 shadow p-3 mb-5">
                        <div class="text-center">
                            <img src="img/logo-login.png" width="400" style="margin-top: -140px;"/>
                            <h5 style="margin-top: -50px;">PROJECT ALCHEMIST</h5>
                            <h5 class="mt-1 text-primary">LOGIN</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('login') }}" id="login-form" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label>Username</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input Username" name="Username" autofocus />
                                    </div>
                                    {{-- @error('email') <div wire:key="form" class="invalid-feedback"> {{$message}} </div> --}}
                                    {{-- @enderror --}}
                                {{-- </div>
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                           
                                            <input wire:model.lazy="password" type="password" placeholder="Input Password"
                                                class="form-control" id="password" name="Password" required>
                                        </div> --}}
                                        {{-- @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror --}}
                                    {{-- </div>
                                    <div class="d-flex justify-content-between align-items-top">
                                        <div class="form-check">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button style="color: white;" type="submit" name="submit" class="btn btn-primary w-100 my-4 mb-2 text-dark" id="login-btn">Login</button>
                                    <p class="mt-1 text-secondary" style="font-size: 14px;">Don't have an account? <a href="{{ route('register') }}" class="text-info">Register</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> --}}

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="asset/img/login-base.png"
                        class="img-fluid" alt="Login Image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="text-center">
                        {{-- <img src="img/logo-login.png" width="400" style="margin-top: -140px;" /> --}}
                        <h5>Login to your Account</h5>
                        <h5 class="mt-1 text-primary">See what is going on with your business</h5>
                        <div class="container m-5">
                            <div class="row align-items-center">
                                <div class="col">
                                    <hr class="line">
                                </div>
                                <div class="col-auto">
                                    <p class="text-center">Sign in with Email</p>
                                </div>
                                <div class="col">
                                    <hr class="line">
                                </div>
                            </div>
                        </div>
                    </div>
                    <form>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form1Example13" class="form-control form-control-lg" />
                            <label class="form-label" for="form1Example13">Email address</label>
                        </div>
    
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="form1Example23" class="form-control form-control-lg" />
                            <label class="form-label" for="form1Example23">Password</label>
                        </div>
    
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>
                            <a href="#!">Forgot password?</a>
                        </div>
    
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
    
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                        </div>
    
                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                            role="button">
                            <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                        </a>
                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                            role="button">
                            <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>
    
                    </form>
                </div>
            </div>
        </div>
    </section>
    
</body>
