<?php

namespace App\Form;

use App\Entity\Education;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('phone', TelType::class)
            ->add('email')
            ->add('education', EntityType::class, [
                'class'        => Education::class,
                'choice_label' => 'name',
            ])
            ->add('agreement', CheckboxType::class, [
                'required' => false,
            ])
        ;

        $builder->get('phone');

        $builder->get('phone')
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $event->setData('+79' . $event->getData());
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();

                if (!is_string($data)) {
                    return;
                }

                $event->setData(
                    substr(
                        preg_replace('/[^\d]/', '', $data),
                        -9
                    )
                );
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
