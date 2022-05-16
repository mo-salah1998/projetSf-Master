<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Gmusee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GmuseeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_musee')
            ->add('nom')
            ->add('place')
            ->add('description')
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped'=> false,
                'required' =>false
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gmusee::class,
        ]);
    }
}
