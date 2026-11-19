<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Login - Aplikasi Parkir</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
</head> 
<body class="bg-light d-flex align-items-center" style="min-height:100vh;"> 
    <div class="container"> 
        <div class="row justify-content-center"> 
            <div class="col-md-4"> 
                <div class="card shadow"> 
                    <div class="card-body"> 
                        <h4 class="text-center mb-4"> Aplikasi Parkir</h4> 
 
                        @if(session('error')) 
                            <div class="alert alert-danger">{{ session('error') }}</div> 
                        @endif 
                           <form method="POST" action="{{ route('login.post') }}"> 
                            @csrf 
                            <div class="mb-3"> 
                                <label class="form-label">Username</label> 
                                <input type="text" name="username" class="form-control" required 
autofocus> 
                            </div> 
                            <div class="mb-3"> 
                                <label class="form-label">Password</label> 
                                <input type="password" name="password" class="form-control" required> 
                            </div> 
                            <button type="submit" class="btn btn-primary w-100">Login</button> 
                        </form> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</body> 
</html>