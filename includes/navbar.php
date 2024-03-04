<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
    
    <!-- Logo on the left -->
    <a class="navbar-brand" href="#">
        <img src="assets/img/logo.png" alt="Logo" style="width: 85%">
    </a>
    <span id="user-name"><?php echo $full_name ?></span>

    <!-- Responsive navbar button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar items -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="planning-tools.php"><i class="fas fa-tools mr-1"></i> Planning Tools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="report-list.php"><i class="fas fa-list mr-1"></i> Report List</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog mr-1"></i> Settings
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="task.php">Tasks</a>
                    <a class="dropdown-item" href="goal.php">Goals</a>
                    <a class="dropdown-item" href="action.php">Actions</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
            </li>
        </ul>
    </div>
    </div>
</nav>