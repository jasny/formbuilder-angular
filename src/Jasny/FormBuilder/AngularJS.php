<?php

namespace Jasny\FormBuilder;

use Jasny\FormBuilder;

/**
 * Render element for use with AngularJS.
 * Optionaly use features from Jasny AngularJS.
 * 
 * @link http://getbootstrap.com
 * @link http://jasny.github.io/bootstrap
 * 
 * @option int version  Which major AngularJS version is used
 */
class AngularJS extends Decorator
{
    protected $deep = true;
    
    /**
     * Apply default modifications.
     * 
     * @param Element $element
     */
    public function apply($element)
    {
        if ($element instanceof Control) {
            if (!isset($element->attr['ng-model'])) $element->attr['ng-model'] = \Closure::bind(function() {
                $model = $this->getOption('model');
                return ($model ? $model . '.' : '') . $this->getName();
            }, $element);
        }
    }
    
    /**
     * Register Boostrap decorator and elements
     * 
     * @return 
     */
    public static function register()
    {
        FormBuilder::$decorators['angularjs'] = 'Jasny\FormBuilder\AngularJS';
    }
}
