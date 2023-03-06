<?php
declare(strict_types=1);

namespace App\Files\Helpers;

trait searchSimiliar
{
    function search(string $str, array $collection)
    {
        $str = $this->get_minification_array($str);
        $count = count($str);
        $out = array();
        foreach ($collection as $row) {
            $verifiable = $this->get_minification_array($row->question);
            $similar_counter = 0;
            foreach ($str as $text_row) {
                foreach ($verifiable as $verifiable_row) {
                    if ($text_row == $verifiable_row) {
                        $similar_counter++;
                        break;
                    }
                }
            }
            $out[$row['id']] = $similar_counter * 100 / $count;
        }
        arsort($out);
        $out = array_slice($out, 0, 10, true);
//        $same = array_search(100,$out);
//        unset($out[$same]);
        $out = array_keys($out);
        return $out;
    }


    function get_minification_array($text)
    {
        // Удаление экранированных спецсимволов
        $text = stripslashes($text);

        // Преобразование мнемоник
        $text = html_entity_decode($text);
        $text = htmlspecialchars_decode($text, ENT_QUOTES);

        // Удаление html тегов
        $text = strip_tags($text);

        // Все в нижний регистр
        $text = mb_strtolower($text);

        // Удаление лишних символов
        $text = str_ireplace('ё', 'е', $text);
        $text = mb_eregi_replace("[^a-zа-яй0-9 ]", ' ', $text);

        // Удаление двойных пробелов
        $text = mb_ereg_replace('[ ]+', ' ', $text);

        // Преобразование текста в массив
        $words = explode(' ', $text);

        // Удаление дубликатов
        $words = array_unique($words);

        // Удаление предлогов и союзов
        $array = array(
            'без', 'близ', 'в', 'во', 'вместо', 'вне', 'для', 'до',
            'за', 'и', 'из', 'изо', 'из', 'за', 'под', 'к',
            'ко', 'кроме', 'между', 'на', 'над', 'о', 'об', 'обо',
            'от', 'ото', 'перед', 'передо', 'пред', 'предо', 'по', 'под',
            'подо', 'при', 'про', 'ради', 'с', 'со', 'сквозь', 'среди',
            'у', 'через', 'но', 'или', 'по', 'что', 'такое', 'можно', 'как', 'ли','PHP'
        );

        $words = array_diff($words, $array);

        // Удаление пустых значений в массиве
        $words = array_diff($words, array(''));

        return $words;
    }
}
