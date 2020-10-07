<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\User;
use App\Entity\Match;
use App\Entity\MatchType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AddMatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('date',DateTimeType::class,['label'=>'Date du match : '])
            ->add('domicile', CheckboxType::class, [
                'mapped' => false,
                'required'=>false,
                'label'=>'Coché si vous jouez a domicile'
            ])
            ->add('local_team',TextType::class,['label'=>'Equipe adverse'])
            ->add('match_type',EntityType::class,[
                'class' => MatchType::class,
                'choice_label' => 'name',
                'label'=>'Type de match'
            ])
            ->add('Submit', SubmitType::class, ['label' => '+ Ajouter', 'attr' => ['class' => 'btn-lg pointer']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'data_class' => Match::class,
            'teams' => Collection::class,
        ]);
    }
}
