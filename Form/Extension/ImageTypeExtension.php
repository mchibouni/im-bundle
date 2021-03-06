<?php

namespace Leapt\ImBundle\Form\Extension;

use Leapt\CoreBundle\Form\Type\ImageType;
use Leapt\ImBundle\Manager;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type to show a preview of the image
 */
class ImageTypeExtension extends AbstractTypeExtension
{
    /**
     * @var Manager
     */
    protected $imManager;

    /**
     * @param Manager $imManager
     */
    public function __construct(Manager $imManager)
    {
        $this->imManager = $imManager;
    }

    /**
     * @return string
     */
    public function getExtendedType()
    {
        return ImageType::class;
    }

    /**
     * @return array
     */
    public static function getExtendedTypes()
    {
        return [ImageType::class];
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'im_format' => null,
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormView      $view
     * @param \Symfony\Component\Form\FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($view->vars['file_url']) && null !== $options['im_format']) {
            $view->vars['file_url'] = $this->imManager->getUrl($options['im_format'], $view->vars['file_url']);
        }
    }
}
