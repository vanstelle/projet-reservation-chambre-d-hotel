<?php

namespace App\Form;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChambreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('drescription')
            ->add('prix')
            ->add('options')
            ->add('photoForm1', FileType::class, [
                "label" => "Image Chambre",
                "mapped" => false,
                "required" => false
            ])
            ->add('photoForm2', FileType::class, [
                "label" => "Image Chambre",
                "mapped" => false,
                "required" => false
            ])
            ->add('photoForm3', FileType::class, [
                "label" => "Image Chambre",
                "mapped" => false,
                "required" => false
            ])
            ->add('photoForm4', FileType::class, [
                "label" => "Image Chambre",
                "mapped" => false,
                "required" => false
            ])
            ->add('photoForm5', FileType::class, [
                "label" => "Image Chambre",
                "mapped" => false,
                "required" => false
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
