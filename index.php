
<?php 
    session_start();
    if (isset($_SESSION['unique_id'])) {
        header('Location: users.php');
    }
?>


<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Real Time Chat App</header>
            <form action="" enctype="multipart/form-data" method="POST" data-ajax="false">
                <div class="error-txt">
                    This is an error message
                </div>
                <div class="name-details">

                    <div class="field input">
                        <label>First Name</label>
                        <input class="formVal" type="text" name="first_name" placeholder="First Name" id="firstName" required>
                    </div>

                    <div class="field input">
                        <label>Last Name</label>
                        <input class="formVal" type="text" name="last_name" placeholder="Last Name" id="lastName" required>
                    </div>

                    <div class="field input">
                        <label>Email</label>
                        <input class="formVal" type="text" name="email" placeholder="Please enter your email" id="email" required>
                    </div>

                    <div class="field input">
                        <label>Password</label>
                        <input class="formVal" type="password" name="password" placeholder="Please enter your password" id="passwordInput" required>
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </div>

                    <div class="field image">
                        <label>Select Image</label>
                        <input class="" type="file" name="image" id="fileToUpload" required>
                    </div>

                    <div class="field button">
                        <input type="submit" value="Continue to chat">
                    </div>

                </div>
            </form>
            <div class="link">
                Already signed up? <a href="login.php">Login here</a>
            </div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>

</html>