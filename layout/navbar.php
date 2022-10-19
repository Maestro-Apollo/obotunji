<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg_color">
        <div class="container">
            <a class="navbar-brand font-weight-bold" style="font-family: 'Lato', sans-serif; color: #481639"
                href="index.php"><img src="./images/06-1024x500.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">



                    <!-- If the user is logged in and session is set then these nav option will show -->
                    <?php if (isset($_SESSION['admin5'])) { ?>


                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="view-code.php">Code</a>
                    </li>
                    <!-- <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="view-users.php">Users</a>
                    </li> -->
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="logout.php">Logout
                        </a>
                    </li>






                    <?php } else { ?>
                    <!-- These are when user is not logged in -->
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="register.php">Home
                        </a>
                    </li>
                    <!-- <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="login.php">Login
                        </a>
                    </li> -->



                    <?php } ?>





                </ul>

            </div>
        </div>
    </nav>
</div>