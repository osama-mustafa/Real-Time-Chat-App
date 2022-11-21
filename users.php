<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header('Location: login.php');
    } else {
        $unique_id = $_SESSION['unique_id'];
    }
?>


<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php 
                    include_once "php/config.php";
                    $select_query = "SELECT * FROM users WHERE unique_id = '{$unique_id}'";
                    $result       = mysqli_query($conn, $select_query);
                    if (mysqli_num_rows($result) > 0) {
                        $auth_user = mysqli_fetch_assoc($result);
                    }      
                ?>
                <div class="content">
                    <img src="php/images/<?php echo $auth_user['image']  ?>" alt="">
                    <div class="details">
                        <span><?php echo $auth_user['first_name'] . " " . $auth_user['last_name'] ?></span>
                        <p><?php echo $auth_user['status'] ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $unique_id ?>" class="logout">Logout</a>
            </header>

            <div class="search">
                <span class="text">select user to start chat</span>
                <input type="text" placeholder="Enter name to search" id="searchBar" name="searchTerm">
                <button id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <div class="users-list">
            </div>
        </section>
    </div>
    <script src="javascript/users.js"></script>
</body>
</html>