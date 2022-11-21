<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header('Location: login.php');
} else {
    $auth_unique_id = $_SESSION['unique_id'];
}


?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>

                <?php
                include_once "php/config.php";
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $select_query = "SELECT * FROM users WHERE unique_id = '{$user_id}'";
                $result = mysqli_query($conn, $select_query);
                if (mysqli_num_rows($result) > 0) {
                    $target_user = mysqli_fetch_assoc($result);
                }

                ?>

                <a href="users.php" class="back-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <img src="php/images/<?php echo $target_user['image']  ?>" alt="">
                <div class="details">
                    <span><?php echo $target_user['first_name'] . " " . $target_user['last_name'] ?></span>
                    <p><?php echo $target_user['status'] ?></p>
                </div>
            </header>
            <div class="chat-box">
            </div>

                <!-- SECURITY ISSUE: Hide outgoing_id & incoming_id from HTML Preview -->

                <form action="" class="typing-area" autocomplete="off">
                <input type="text" name="message" placeholder="type a message here" class="input-field formVal">
                <input name="outgoing_id" value="<?php echo $auth_unique_id ?>" class="formVal" hidden>
                <input name="incoming_id" value="<?php echo $user_id ?>" class="formVal" hidden>
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
        <script src="javascript/chat.js"></script>
    </div>
</body>

</html>