<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigTest;

class AppExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('instanceof', [$this, 'isInstanceof'])
        ];
    }

    /**
     * @param $var
     * @param $instance
     * @return bool
     */
    public function isInstanceof($var, $instance) {
        return  $var instanceof $instance;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_string', [$this, 'isString']),
            new TwigFunction('is_array', [$this, 'isArray']),
        ];
    }

    public function isString($variable): bool
    {
        return is_string($variable);
    }

    public function isArray($variable): bool
    {
        return is_array($variable);
    }


}
