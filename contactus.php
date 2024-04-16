<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<?php 
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

session_start();

$conn = mysqli_connect($host, $user, $password, $database);

$name="";
$email="";
$user_id=NULL;
$readonly="";
if (isset($_SESSION['user_id'])){
    $sql = "SELECT first_name,last_name,email FROM user_resumes where user_id = '".$_SESSION['user_id']."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row["first_name"]." ".$row["last_name"];
    $email = $row["email"];
    $user_id = $_SESSION['user_id'];
    $readonly="readonly";
}
?>
<body>
    <section id="contact" class="contact py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center mb-4">Contact Us</h2>
                    <form action="submit_contact.php" method="POST">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $name;?>" <?php echo $readonly; ?> required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $email;?>" <?php echo $readonly; ?> required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<p class="text-center mt-3">Thank you for contacting us, ' . $_SESSION['username'] . '!</p>';
                    } else {
                        echo '<p class="text-center mt-3">Thank you for contacting us!</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
