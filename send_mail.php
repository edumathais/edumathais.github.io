<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
        $mail->Username = 'votre-email@gmail.com';
        $mail->Password = 'votre-mot-de-passe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom($email, 'Contact Form');
        $mail->addAddress('mronald.reagan@gmail.com');

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<html><body>
                          <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                          <p><strong>Sujet:</strong> " . htmlspecialchars($subject) . "</p>
                          <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
                          </body></html>";

        $mail->send();
        echo 'Message envoyé avec succès.';
    } catch (Exception $e) {
        echo "Échec de l'envoi du message. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>

