<?php 
    session_start();
    if (isset($_SESSION['unique_id'])) {
        header('Location: users.php');
    }
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>Real Time Chat App</header>
            <form action="">
                <div class="error-txt">
                    This is an error message
                </div>
                <div class="name-details">

                    <div class="field input">
                        <label>Email</label>
                        <input class="formVal" type="email" name="email" placeholder="Please enter your email" required>
                    </div>

                    <div class="field input">
                        <label>Password</label>
                        <input class="formVal" type="password" name="password" placeholder="Enter your password" id="passwordInput" required>
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </div>

                    <div class="field button">
                        <input type="submit" value="Continue to chat">
                    </div>

                </div>
            </form>
            <div class="link">
                Not yet signed up? <a href="index.php">Signup now</a>
            </div>
        </section>
        <script src="javascript/pass-show-hide.js"></script>
        <script src="javascript/login.js"></script>
    </div>
</body>

</html>