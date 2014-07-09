<?php

namespace Jasny\FormBuilder;

use Jasny\FormBuilder;

/**
 * Modify controls to work with AngularJS.
 * 
 * @link http://getbootstrap.com
 * @link http://jasny.github.io/bootstrap
 * 
 * @option boolean omit-name-attr Remove auto-defined name attributes
 */
class Angular extends Decorator
{
    /**
     * Remove auto-defined name attributes
     * @var boolean
     */
    protected $omitNameAttr = false;
    
    /**
     * Apply to all decendants
     * @var boolean
     */
    protected $deep = true;
    
    
    /**
     * Class constructor
     * 
     * @param array $options
     */
    public function __construct(array $options=[])
    {
        $this->omitNameAttr = !empty($options['omit-name-attr']);
    }
    
    /**
     * Apply default modifications.
     * 
     * @param Element $element
     */
    public function apply($element)
    {
        if ($element instanceof Form && !isset($element->attr['novalidate'])) {
            $element->attr['novalidate'] = true;
        }
        
        if ($element instanceof Control) {
            if (!isset($element->attr['ng-model'])) $element->attr['ng-model'] = \Closure::bind(function() {
                $model = $this->getOption('ng-model');
                return ($model ? $model . '.' : '') . $this->getName();
            }, $element);
            
            if ($this->omitNameAttr && $element->attr['name'] instanceof \Closure) {
                unset($element->attr['name']);
            }
        }
    }
    
    /**
     * Register Boostrap decorator and elements
     * 
     * @return 
     */
    public static function register()
    {
        FormBuilder::$decorators['angular'] = 'Jasny\FormBuilder\Angular';
    }
}
