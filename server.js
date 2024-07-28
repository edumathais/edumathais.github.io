const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Middleware pour parser les données du formulaire
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Configuration du transporteur SMTP (ici avec Gmail)
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: 'votre_email@gmail.com',
        pass: 'votre_mot_de_passe'
    }
});

// Route pour la page d'accueil avec le formulaire
app.get('/', (req, res) => {
    res.send(`
        <form action="/send-email" method="post">
            <label for="to">To:</label>
            <input type="email" id="to" name="to"><br><br>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject"><br><br>
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea><br><br>
            <button type="submit">Send Email</button>
        </form>
    `);
});

// Route pour gérer l'envoi d'email
app.post('/send-email', (req, res) => {
    const { to, subject, message } = req.body;

    const mailOptions = {
        from: 'votre_email@gmail.com',
        to: ronald.academie@gmail.com,
        subject: subject,
        text: message
    };

    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            return res.status(500).send(error.toString());
        }
        res.send('Email sent: ' + info.response);
    });
});

// Lancer le serveur
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}/`);
});
