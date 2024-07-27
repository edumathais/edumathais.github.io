<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('PHPMailer'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Exception.php');
require('PHPMailer'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'PHPMailer.php');
require('PHPMailer'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'SMTP.php');
$mail = new PHPMailer(true);
try{
    // Configuration du serveur
    $mail->isSMTP();
    $mail->Host         = 'adresse-serveur-smtp';
    $mail->SMTPAuth        = true;
    $mail->Username        = 'identifiant@mail';
    $mail->Password        = 'mot_de_passe';
    $mail->SMTPSecure    = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port        = 587; //465
    // Adresses
    $mail->setFrom('adresse_affichée_expéditeur', 'nom_affiché_expéditeur');
    $mail->addAddress('ronald.academie@gmail.com', 'Ronald');
    $mail->addReplyTo('adresse_mail_de_réponse', 'nom de réponse');
        $mail->addCC('adresse_mail_copie');
    $mail->addBCC('adresse_mail_cachée');
    // pièce jointe
    $mail->addAttachment('/chemin/vers/piece/jointe', '/chemin/vers/seconde/piece/jointe');
    // contenu
    $mail->isHTML(true);
    $mail->Subject        = 'Sujet du mail';
    $mail->Body        = 'C\'est le corps du <strong>message</strong>';
    $mail->AltBody        = 'Un corps alternatif si la version HTML ne peut être affiché';
    $mail->send();
    echo 'Mail envoyé';
} catch ( Exception $e ){
    echo 'Le message ne peut pas être envoyé. Mailer erreur : '.$mail->ErrorInfo;
}
?>
