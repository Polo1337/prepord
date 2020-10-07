<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Team;
use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            // ajouter des types de fichier entrée pour notre formulaire
            // add an input filetype for our form
            ->add('lest_name',TextType::class,['label'=>'Nom'])
            ->add('first_name',TextType::class,['label'=>'Prénom'])
            ->add('picture', FileType::class, array('data_class' => null,
                                                    'label'=>'Photo',
                                                    'required' => false,                                                    
                                                    ))
            ->add('birth_date',DateType::class,[
                'days' => range(1, 31),
                'months' => range(1, 12),
                'years' => range(date('Y')-60, date('Y') ),
            ],['label'=>'Date de naissance'])
            ->add('club_entry_date',DateType::class,['label'=>'Date d\'entrée au club'])
            ->add('license_number',NumberType::class,['label'=>'N° de license'])
            ->add('is_post', EntityType::class, [
                'class' => Post::class,
                'label'=>'Postes occupés',
                'choice_label' => 'post',
                'multiple' => true,
                'expanded' => true,])
            ->add('play_in', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'category',
                'multiple' => true,
                'expanded' => true,
                'label'=>'Jouera en'])
            ->add('Submit', SubmitType::class, ['label' => '+ Ajouter', 'attr' => ['class' => 'btn-lg pointer']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
