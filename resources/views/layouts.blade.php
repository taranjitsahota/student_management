{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title","Student app")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>
<style>
    .container-form {
            margin-left: 100px;
            padding: 20px;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            padding-top: 1rem; /* Adjust according to your header height */
            background-color: #c9e8f7 !important;
            border-right: 1px solid #dee2e6;
        }

        .sidebar-heading {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 1rem;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 0.5rem 1rem;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #343a40;
        }

        .sidebar ul li a:hover {
            color: #007bff;
        }

        .main-content {
            margin-left: 250px; /* Width of the sidebar */
            padding: 20px;
        }
        .error-message {
            color: red;
            font-size: 14px;
        }
</style>
<body>
    
    <div class="container-fluid">
        <div class="row">
            
            <aside class="col-md-3 bg-light sidebar" id="sidebar">
                <div class="p-3">
                    <h4>DPS School</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/student_form') }}">Add new Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/student_data') }}">All Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/searchstudent') }}">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </aside>

           
            <main class="col-md-9">
                <div class="container-form">
                    @yield("content")
                </div>
            </main>
        </div>
    </div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title","Student app")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>
<style>
    .container-form {
        margin-left: 100px;
        padding: 20px;
        width: 100%;
    }
    .sidebar {
        position: fixed;
        top: 81px;
        left: 0;
        height: 100%;
        width: 200px;
        padding-top: 1rem; /* Adjust according to your header height */
        background-color: #73c0e4 !important;
        border-right: 1px solid #dee2e6;
    }

    .sidebar-heading {
        font-size: 1.2rem;
        font-weight: bold;
        padding: 1rem;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 0.5rem 1rem;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: #343a40;
    }

    .sidebar ul li a:hover {
        color: #007bff;
    }

    .main-content {
        margin-left: 250px; /* Width of the sidebar */
        padding: 20px;
    }
    .error-message {
        color: red;
        font-size: 14px;
    }
    .navbar {
        background-color: #333;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff;
    }
    .navbar-brand img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }
    .navbar.sticky-top {
    /* position: fixed; */
    top: 0;
    width: 100%;
    z-index: 1030;
    background-color: #73c0e4 !important;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
}

.background-layer {
  position: fixed;
  top: 81px; /* adjust to match the height of your navbar */
  right: 0;
  bottom: 0;
  left: 200px; /* adjust to match the width of your sidebar */
  z-index: -1; /* send it to the back */
  background-image: url('{{ asset('images/backschool.jpg') }}');
  background-size: cover;
  background-position: center;
  background-size: 100% 100vh;
  opacity: 0.8; /* adjust the transparency level */
}
</style>
<body>
    <div class="background-layer"></div>
    <nav class="navbar sticky-top">
        <div class="navbar-brand">
            <img src="{{ asset('images/delhi-public-school-logo.png') }}" alt="DPS Logo">
            Welcome to Delhi Public School
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-3 bg-light sidebar" id="sidebar">
                <div class="p-3">
                    <h4>DPS School</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/student_form') }}">Add new Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/student_data') }}">All Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/searchstudent') }}">Search</a>
                        </li>
                    </ul>
                </div>
            </aside>

            <main class="col-md-9">
                <div class="container-form">
                    @yield("content")
                </div>
            </main>
        </div>
    </div>
</body>
</html>