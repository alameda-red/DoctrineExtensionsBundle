<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\DQL\Geo;

use Alameda\Component\InternationalSystemOfUnits\Converter;
use Alameda\Component\InternationalSystemOfUnits\Length;
use Alameda\Component\Science\Science;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\SimpleArithmeticExpression;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Distance ::= "ALAMEDA_GEO_DISTANCE" "(" SimpleArithmeticExpression "," SimpleArithmeticExpression "," SimpleArithmeticExpression "," SimpleArithmeticExpression ")"
 *
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bridge\Doctrine\DQL
 */
final class Distance extends FunctionNode
{
    /** @var SimpleArithmeticExpression */
    public $a_lat, $a_long, $b_lat, $b_long;

    /**
     * @param Parser $parser
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->a_lat = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_COMMA);

        $this->a_long = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_COMMA);

        $this->b_lat = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_COMMA);

        $this->b_long = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * @param SqlWalker $walker
     * @return string
     */
    public function getSQL(SqlWalker $walker)
    {
        $lat_a = $walker->walkSimpleArithmeticExpression($this->a_lat);
        $lat_b = $walker->walkSimpleArithmeticExpression($this->b_lat);

        $delta_lat = sprintf('%s-%s', $lat_b, $lat_a);
        $delta_lon = sprintf('%s-%s', $walker->walkSimpleArithmeticExpression($this->b_long), $walker->walkSimpleArithmeticExpression($this->a_long));

        $a = sprintf('POW(SIN(RADIANS(%s/2)),2)+COS(RADIANS(%s))*COS(RADIANS(%s))*POW(SIN(RADIANS(%s/2)),2)',
            $delta_lat,
            $lat_a,
            $lat_b,
            $delta_lon
        );

        $c = sprintf('2*ATAN2(RADIANS(SQRT(%s)),RADIANS(SQRT(1-%s)))',
            $a,
            $a
        );

        $result = sprintf('(%s*%s)',
            Converter::convert(Science::EARTH_RADIUS, Length::METRE, Length::KILOMETRE),
            $c
        );

        return $result;
    }
} 