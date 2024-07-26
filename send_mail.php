<?php
// Inclure l'autoloader de Composer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['contact-email'];
    $subject = $_POST['contact-subject'];
    $message = $_POST['contact-message'];

    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'votre-email@gmail.com'; // Remplacez par votre adresse email Gmail
        $mail->Password = 'votre-mot-de-passe'; // Remplacez par votre mot de passe ou mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom($email, 'Contact Form');
        $mail->addAddress('mronald.reagan@gmail.com'); // Remplacez par l'adresse email de destination

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<html><body>
                          <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                          <p><strong>Sujet:</strong> " . htmlspecialchars($subject) . "</p>
                          <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
                          </body></html>";

        $mail->send();
        $message_sent = true;
    } catch (Exception $e) {
        $error = "Échec de l'envoi du message. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
</head>
<body>
    <?php if (!empty($message_sent)): ?>
        <h2>Message envoyé avec succès.</h2>
    <?php elseif (!empty($error)): ?>
        <h2><?php echo $error; ?></h2>
    <?php endif; ?>

    <form action="" method="post">
        <label for="contact-email">Email:</label>
        <input type="email" id="contact-email" name="contact-email" required>
        <br>
        <label for="contact-subject">Sujet:</label>
        <input type="text" id="contact-subject" name="contact-subject" required>
        <br>
        <label for="contact-message">Message:</label>
        <textarea id="contact-message" name="contact-message" required></textarea>
        <br>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
