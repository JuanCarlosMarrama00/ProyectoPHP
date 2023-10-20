<?php



namespace App\Form;



use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;



use App\Entity\Artista;





class CancionType extends AbstractType

{

    public function buildForm(FormBuilderInterface $builder, array $options)

    {

        $builder
            ->add('nombre', TextType::class)
            ->add('publicacion', TextType::class, ['label' => 'Año de publicación'])
            ->add('artista', EntityType::class, array('class' => Artista::class, 'choice_label' => 'nombre'))
            ->add('save', SubmitType::class, array('label' => 'Enviar'));
    }
}
