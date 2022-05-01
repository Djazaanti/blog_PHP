<?php
declare(strict_types=1);

namespace Oc\Blog\controller;

use Oc\Blog\service\TwigService;
use Oc\Blog\model\ContactModel;

class ContactController
{
    /**
     * @var TwigService Twig
     */
    private TwigService $twigService;

    /**
     * @var ContactModel The contact model to make request
     */
    private ContactModel $contactModel;

    /**
     * Le constructeur de la classe ContactController.
     * Il attend en paramètre twig pour afficher les vues
     * @param TwigService $twigService
     */
    public function __construct(TwigService $twigService)
    {
        // Je stock la configuration du service twig dans notre variable twig du controller
        $this->twigService = $twigService;
    }

    public function submitFormContact($name, $lastname, $email, $message)
    {
        // check email format. If not valid we send error message
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // if (false === $email ) {
            $_SESSION['flash'] = 'error';
            $_SESSION['flash_message'] = 'Une erreur est survenue. Veuillez vérifier votre email.';
        }

        // TODO: send email
        $recever = 'alidjazaanti1@gmail.com';
        $subject = 'Formulaire de contact';
        $headers = 'FROM : '.$email ;
        mail($recever, $subject, $message, $headers);

        // After send email we send success message
        $_SESSION['flash'] = 'success';
        $_SESSION['flash_message'] = 'Votre email a bien été envoyé';
        // echo 'formulaire soummis';
        
        // After sending email we redirect to homepage with contact anchor
        header('Location: /#contact');
        var_dump($_SESSION);
        exit;
    }

}