<?php


namespace App\Form;


use App\Entity\Users;
use OpenApi\Annotations as OA;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @OA\RequestBody(
 *     request="Signup",
 *     required=true,
 *     @OA\JsonContent(
 *          required={"username", "mail", "password"},
 *          @OA\Property(type="string", property="username"),
 *          @OA\Property(type="string", property="mail"),
 *          @OA\Property(type="string", property="password"),
 *     )
 * )
 */
class SignupForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("username", TextType::class)
            ->add("mail", EmailType::class)
            ->add("password", RepeatedType::class, [
                'type' => PasswordType::class
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver->setDefaults([
            'data_class' => Users::class
        ]);
    }

}