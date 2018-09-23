<?php
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task', TextType::class,array('attr' => array('class'=> 'form-control')))
            ->add('taskPriority', TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('taskComment', TextareaType::class,array('attr' => array('class' => 'form-control')))
            ->add('taskStatus', TextType::class,array('attr' => array('class' => 'form-control')));
      
    }
}
?>