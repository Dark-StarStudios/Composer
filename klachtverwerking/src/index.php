<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //Load Composer's autoloader
    require '../vendor/autoload.php';
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    use Symfony\Component\Dotenv\Dotenv;

    $dotenv = new Dotenv();

    // $dotenv = Dotenv::createImmutable(__DIR__.'../.env');
    // $dotenv->load();

    $dotenv->load('../.env');
    
    // $env = parse_ini_file(filename:".env");

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if(isset($_POST['email']) && isset($_POST['naam']) && isset($_POST['title']) && isset($_POST['omschrijving_klacht'])){
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $_ENV["USERNAME"];                     //SMTP username
            $mail->Password   = $_ENV["PASSWORD"];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $mail->setFrom('vlasov.nik45@gmail.com', 'Nikita');
            $mail->addAddress($_POST['email'], $_POST['naam']);     //Add a recipient
    
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $_POST['title'];
            $mail->Body    = $_POST['omschrijving_klacht'];
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    ?>
    <form action="index.php" method="post" style="display: flex; flex-direction:column; ">
        <input type="email" name="email" placeholder="Typ hier u email in" />
        <input type="naam" name="naam" placeholder="Typ hier u naam in" />
        <input type="title" name="title" placeholder="Typ hier u title in" />
        <textarea name="omschrijving_klacht" rows="4" cols="50" placeholder="Typ hier een omschrijving klacht in"></textarea>
        <input type="submit" value="Submit" />
    </form>
</body>
</html>