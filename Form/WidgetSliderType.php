<?php

namespace Victoire\Widget\SliderBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetSliderType form type
 */
class WidgetSliderType extends WidgetType
{
    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityName = $options['entityName'];
        $namespace = $options['namespace'];
        $mode = $options['mode'];

        //choose form mode
        if ($entityName === null) {
            //if no entity is given, we generate the static form
            $builder->add('sliderItems', 'collection', array(
                        'type'         => new WidgetSliderItemType($entityName, $namespace, $options['widget']),
                        'allow_add'    => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'options'      => array(
                            'namespace'  => $namespace,
                            'entityName' => $entityName,
                            'mode'       => $mode
                        ),
                        "attr"         => array('id' => 'static')
                    ));
        } else {
            //else, WidgetType class will embed a EntityProxyType for given entity

            $builder
                ->add('page', null,
                    array(
                        "label" => "",
                        "attr"  => array("class" => "hide")
                    )
                )
                ->add('slot', 'hidden')

                ->add('fields', 'widget_fields', array(
                    "namespace" => $namespace,
                    "widget"    => $options['widget']
                ))
                ->add('sliderItems', 'collection', array(
                        'type'         => new WidgetSliderItemType($entityName, $namespace, $options['widget']),
                        'allow_add'    => true,
                        'by_reference' => false,
                        'options' => array(
                            'namespace' => $namespace,
                            'entityName' => $entityName,
                            'mode' => $mode
                        ),
                        "attr"         => array('id' => $entityName)
                ));
        }

        parent::buildForm($builder, $options);
    }

    /**
     * bind form to WidgetRedactor entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\SliderBundle\Entity\WidgetSlider',
            'widget'             => 'widgetslideritem',
            'translation_domain' => 'victoire'
        ));
    }

    /**
     * get form name
     *
     * @return string The form name
     */
    public function getName()
    {
        return 'victoire_widget_form_slider';
    }
}