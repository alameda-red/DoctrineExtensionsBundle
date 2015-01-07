<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\SimpleArithmeticExpression;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * SinFunction ::= "SIN" "(" ArithmeticPrimary ")"
 *
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bridge\Doctrine\DQL
 */
final class Acosh extends FunctionNode
{
    /** @var SimpleArithmeticExpression */
    public $x;

    /**
     * @param Parser $parser
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->x = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * @param SqlWalker $walker
     * @return string
     */
    public function getSQL(SqlWalker $walker)
    {
        return sprintf('ACOSH(%s)', $walker->walkSimpleArithmeticExpression($this->x));
    }
} 