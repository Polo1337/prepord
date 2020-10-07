<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CoachFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('email',TextType::class,['label'=>'Email du coach à ajouter'])
            ->add('Submit', SubmitType::class, ['label' => '+ Ajouter', 'attr' => ['class' => 'btn-lg pointer']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
