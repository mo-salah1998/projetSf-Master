<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Form\RegistrationFormType;
use App\Form\ResetPasswordType;
use App\Security\UsersAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UsersAuthenticator $authenticator,\Swift_Mailer $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(["ROLE_ADMIN"]);
            $random = random_int(2, 10000);
            $user->code = $random;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $message = (new \Swift_Message('Activation du compte'))
                // On attribue l'expéditeur
                ->setFrom('azizhammami621@gmail.com')
                // On attribue le destinataire
                ->setTo($user->getEmail())
                // On crée le texte avec la vue
                ->setBody(
                    $this->renderView(
                        'registration/activation.html.twig', ['code' => $user->code]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );



        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }




}




