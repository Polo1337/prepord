<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Season;
use App\Entity\MatchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormAddTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // ajout un type de fichier entrée pour notre formulaire
        // add an input filetype for our form
        ->add('category',TextType::class,['label'=>'La category de la nouvelle equipe'])
        ->add('play_season',EntityType::class,[
            'class' => Season::class,
            'choice_label' => 'name',
            'label'=>'Choisissez la saison'])
        ->add('picture', FileType::class, array('data_class' => null,
            'label'=>'Photo',
            'required' => false,                                                    
            ))
    ;}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
