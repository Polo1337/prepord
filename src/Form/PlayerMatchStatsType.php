<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\PlayerMatchStats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlayerMatchStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('essais')
            ->add('transformations')
            ->add('penalites')
            ->add('drops')
            ->add('rouges')
            ->add('jaunes')
            ->add('temps')
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,]);
    }
}
