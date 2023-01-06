<nav class="main-header navbar navbar-expand navbar-primary  navbar-dark border-bottom-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->



        <li class="nav-item">
            <form id="logout" action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary mt-1"><i class="fas fa-sign-out-alt mr-2"></i>
                    Logout</button>
            </form>
        </li>
    </ul>
</nav>
