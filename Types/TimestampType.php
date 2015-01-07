<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

/**
 * TimestampType
 *
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Types
 */
class TimestampType extends Type
{
    const TYPE = 'timestamp';

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getDateTimeTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @throws ConversionException
     * @return \DateTime|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (! is_null($value)) {
            if (is_string($value)) {
                try {
                    return new \DateTime($value);
                } catch (\Exception $e) {
                    throw ConversionException::conversionFailed($value, $this->getName());
                }
            }

            if (is_object($value)) {
                throw new ConversionException('Could not convert database value of class "' . get_class($value) . '" to Doctrine Type ' . $this->getName());
            } else {
                throw new ConversionException('Could not convert database value of type "' . gettype($value) . '" to Doctrine Type ' . $this->getName());
            }
        }

        return null;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @throws ConversionException
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (is_object($value) && $value instanceof \DateTime) {
            return $value->format($platform->getDateTimeFormatString());
        } else {
            if (is_null($value)) { return null; }

            if (is_object($value)) {
                throw new ConversionException('Could not convert database value of class "' . get_class($value) . '" to Doctrine Type ' . $this->getName());
            } else {
                throw new ConversionException('Could not convert database value of type "' . gettype($value) . '" to Doctrine Type ' . $this->getName());
            }
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::TYPE;
    }
} 