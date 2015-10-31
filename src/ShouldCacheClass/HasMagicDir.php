<?php

namespace EdpSuperluminal\ShouldCacheClass;

use Zend\Code\Reflection\ClassReflection;

class HasMagicDir implements SpecificationInterface
{

    /**
     * @param ClassReflection $class
     * @return bool
     */
    public function isSatisfiedBy(ClassReflection $class)
    {
        return (static::hasDIR($class->getFileName()));
    }

    protected static function hasDIR($classFilePath) {
        $ret = false;
        $fh = fopen($classFilePath,'r');
        while ($line = fgets($fh)) {
            if(strstr($line, '__DIR__')) {
                $ret = true;
                break;
            }
        }
        fclose($fh);
        return $ret;
    }
}