@extends('layout.templateuser')
@section('content')
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36"
                        alt=""></a>
            </div>
            <form class="card card-md" action="/store" method="post" autocomplete="on" novalidate>
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Create new account</h2>
                    <div class="mb-3">
                        <label class="form-label required">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name"
                            autocomplete="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="form-control @error('username') is-invalid @enderror" placeholder="Enter Username"
                            autocomplete="username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Email Address</label>
                        <input type="email" inputmode="email" name="email" id="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            autocomplete="off">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Confirm Password</label>
                        {{-- <div class="input-group input-group-flat"> --}}
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            autocomplete="off">
                        {{-- <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span> --}}
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        {{-- </div> --}}
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" />
                            <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms
                                    and policy</a>.</span>
                        </label>
                    </div> --}}
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Create new account</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                Already have account? <a href="/" tabindex="-1">Sign in</a>
            </div>
        </div>
    </div>
@endsection
