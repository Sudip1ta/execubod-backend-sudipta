<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .rounded-t-5 {
          border-top-left-radius: 0.5rem;
          border-top-right-radius: 0.5rem;
        }

        section.text-center.text-lg-start {
            margin-top: 6rem;    
            margin-right: 10rem;
            margin-left: 14rem;
        }
        label.form-label {
            float: left;
        }
    
        @media (min-width: 992px) {
          .rounded-tr-lg-0 {
            border-top-right-radius: 0;
          }
    
          .rounded-bl-lg-5 {
            border-bottom-left-radius: 0.5rem;
          }
        }

        .card{
            border:none;
        }
      </style>
</head>
<body>

        
            <!-- Section: Design Block -->
<section class=" text-center text-lg-start">
    
    <div class="card mb-3">
      <div class="row g-0 d-flex align-items-center">
        <div class="col-lg-4 d-none d-lg-flex">
          <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
            class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
        </div>
        <div class="col-lg-8">
          <div class="card-body py-5 px-md-5">
  
            <form method="post" action="{{ url('verify')}}" autocomplete="off">
              <!-- Email input -->
              @csrf
              <div class="col-md-12">
                <h4 style="text-align: center">Execubod Admin Panel</h4>
               
              </div>
              @if(session()->has('error'))
              <div class="col-md-12 alert alert-danger">
                  {{ session()->get('error') }}
              </div>
                @endif
              <div class="form-outline mb-4">
                <label class="form-label" for="email">Email address</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email')}}"  autocomplete="off" />
               
              </div>
  
              <!-- Password input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="off" class="form-control" />
                
              </div>
  
              <!-- 2 column grid layout for inline styling -->
              <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                  </div>
                </div>
  
                <div class="col">
                  <!-- Simple link -->
                  <a href="#!">Forgot password?</a>
                </div>
              </div>
  
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
  
            </form>
  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
        

    {{-- <div class="container mt-5">
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
      
        <h4 style="text-align: center">Login</h4>
        <form method="post" action="{{ url('verify')}}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="">Email</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="off" required>
                </div>

                <div class="col-md-12">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>

        </form>
           
    </div> --}}
    
</body>
</html>