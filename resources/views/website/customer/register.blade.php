@extends('.layouts.web')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 ">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Create New Account</h3>
                            <form action="{{ route('customer.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <span style="color:red;">*</span>First Name</label>
                                            <input type="text" name="name" class="form-control form-control-lg"
                                                value="{{ old('fname') }}" placeholder="Enter Name...." />
                                            @error('fname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <span style="color:red;">*</span>Email</label>
                                            <input type="text" name="email" class="form-control form-control-lg"
                                                value="{{ old('email') }}" placeholder="Enter Email..." />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <span style="color:red;">*</span>Password</label>
                                            <input type="text" name="password" class="form-control form-control-lg"
                                                value="{{ old('password') }}" placeholder="Enter Password...." />
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2" style="padding-left: 450px;">
                                    <button type="submit" class="btn hvr-hover">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
