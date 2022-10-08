<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg_color">
        <div class="container">
            <a class="navbar-brand font-weight-bold" style="font-family: 'Lato', sans-serif; color: #481639"
                href="index.php">Inventory</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">



                    <!-- If the user is logged in and session is set then these nav option will show -->
                    <?php if (isset($_SESSION['admin'])) { ?>

                    <!-- <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="profile.php">Profile
                        </a>
                    </li> -->
                    <!-- <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="result.php">Result
                        </a>
                    </li> -->


                    <!-- <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="about_us.php">About Us
                        </a>
                    </li> -->
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="index.php">Home</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="logout.php">Logout
                        </a>
                    </li>
                    <!-- Bell color changing depending on progress -->





                    <?php } else if (isset($_SESSION['name'])) { ?>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="inventory-list.php">Inventory List
                        </a>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="logout.php">Logout
                        </a>
                    </li>
                    </li>
                    <?php } else { ?>
                    <!-- These are when user is not logged in -->
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="login.php">Login
                        </a>
                    </li>
                    <!-- <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="register.php">Register
                        </a>
                    </li> -->


                    <?php } ?>





                </ul>

            </div>
        </div>
    </nav>
</div>