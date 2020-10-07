<?php

namespace App\Form;

use App\Entity\Match;
use App\Entity\Player;
use App\Form\MatchStatsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MatchStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder

            ->add('recScore',TextType::class,['label'=>'Équipe locale'])
            ->add('visiteurScore',TextType::class,['label'=>'Équipe Visiteur'])
            ->add('save', SubmitType::class, ['label' => 'Sauvegarder',
                'attr' => ['class' => 'save btn-lg pointer'],
            ]);
    }
}
