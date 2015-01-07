<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\Types;

use Alameda\Component\DateTime\DateInterval;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

/**
 * DateIntervalType
 *
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Types
 */
class DateIntervalType extends Type
{
    const TYPE = 'dateinterval';

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @throws ConversionException
     * @return \DateInterval|mixed|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (! is_null($value)) {
            try {
                return new \DateInterval($value);
            } catch (\Exception $e) {
                throw ConversionException::conversionFailed($value, $this->getName());
            }
        } else {
            return null;
        }
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (! is_null($value) || $value instanceof \DateInterval)
            ? DateInterval::getString($value)
            : null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::TYPE;
    }
} 