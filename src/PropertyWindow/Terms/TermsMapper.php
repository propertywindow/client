<?php
declare(strict_types = 1);

namespace PropertyWindow\Terms;

/**
 * Class TermsMapper
 */
class TermsMapper
{
    /**
     * @param array $input
     *
     * @return Terms
     */
    public static function toTerm(array $input): Terms
    {
        $term = new Terms();

        $term->setId($input['id']);
        $term->setName($input['term']);
        $term->setShowPrice($input['show_price']);

        return $term;
    }

    /**
     * @param array $input
     *
     * @return Terms[]
     */
    public static function toTerms(array $input): array
    {
        $result = [];

        foreach ($input as $value) {
            $result[] = self::toTerm($value);
        }

        return $result;
    }
}