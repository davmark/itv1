<?php
namespace common\components;

use yii\bootstrap\Html;

/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 2/18/2016
 * Time: 12:08
 */

//search bՖԴԳԴՖDDDD sssdfgsdgsg
class Search {
    /**
     * Элементы в которых надо осуществить поиск
     * @var array
     */
    private $items;

    /**
     * Результат поиска
     * @var array
     */
    private $result = [];

    /**
     * Ключи по которым нужно искать в элементах и их вес
     * например: array('title' => 3, 'desc' => 0.7, 'author' => 5)
     * @var array
     */
    private $keywords;

    /**
     * Разбтое словосочетание на слова по которым надо искать
     * @var array
     */
    private $words = [];

    /**
     * Текст который нужно найти
     * @var string
     */
    private $text;

    /**
     * Минимальная длинна слова которое нужно найти
     * @var int
     */
    private $word_min_length;

    /**НЕ ИСПОЛЬЗУЕТСЯ
     * Шаблон поиска слов
     * @var string
     */
    private $match_pattern = '';

    /**
     * С какого элемента выводить результат
     * @var int
     */
    private $offset = 0;

    /**
     * Сколько элементов выводить
     * @var int
     */
    private $limit = 1000;

    public function __construct($text, $items, $search_in, $word_min_length = 0){
        $this->items = $items;
        $this->keywords = $search_in;
        $this->text = $text;
        $this->word_min_length = $word_min_length;
        $this->text_to_array();
        $this->search();
    }

    public function debug(){
        return $this->result;
    }


    /**
     * Переводим текст в массив со словами
     * @return NULL
     */
    private function text_to_array() {

        $this->words = explode(" ",$this->text);
        $i = 0;

        foreach ($this->words as $word) {

            $word = trim($word);

            if(empty($word)){
                unset($this->words[$i++]);
                continue;
            }

            if($this->word_min_length){

                if (mb_strlen($word) < $this->word_min_length) {
                    unset($this->words[$i]);
                }else {
                    $this->words[$i] = str_ireplace('.', '\.', $word);
                }

            }else{
                $this->words[$i] = str_ireplace('.', '\.', $word);
            }
            $i++;
        }
    }

    /**
     * Закрашиваем слова
     * @param string $search    -Слово которое нужно раскрасить
     * @param string $string    -Строка в которои данное слово
     * @param string $color     -HEX цвет в формате HTML например: #fff
     * @return string
     */
    private function colorize($search, $string, $color) {

        $result = preg_replace('/('.$search.')/ius',"<span style='background-color:".$color.";'>$1</span>",$string);

        return $result;
    }

    /**
     * Очищает строку
     * @param string $str
     * @return string
     */
    private function string_clean($str){
        return Html::encode(strip_tags($str));
    }

    /**
     * Основной поиск
     */
    private function search() {
        if(empty($this->words) OR empty($this->keywords) OR empty($this->items)) return;
        $i = 0.0000000001;
        foreach ($this->items as $key => $item) {
            $this->items[$key]['weight'] = (double)0;
            $weight = (double)0;
            $tmp_item = []; //echo '<pre>';var_dump($this->keywords);

            foreach($this->words as $word){
                foreach($this->keywords as $field => $value){
                    $s_word = strip_tags($word);
                    $s_word = urlencode($s_word);
                    $weight += (double)preg_match_all('/('.$s_word.')/ius',$this->string_clean($item[$field]),$out) * $value;

                }
            }
            $this->items[$key]['weight'] = $weight;//echo $field.'-'.$weight.' '.$this->items[$key]['title'].'<br />';
            $i +=0.0000000001;
            if($this->items[$key]['weight']!=0) {
                $this->result[(string)($this->items[$key]['weight']-$i)] = $item;
            }else {
                unset($this->items[$key]);
            }
        }
        if(!empty($this->result))
            krsort($this->result);
    }


    /**
     * Возвращает колво записей
     * @return int
     */
    public function get_items_count(){
        return count($this->result);
    }

    /**
     * Определяет с какой записи выводить результат
     * @param int $offset
     * @return object $this
     */
    public function set_offset($offset){
        $this->offset = $offset;
        return $this->offset;
    }

    /**
     * Определяет сколько элементов выводить
     * @param int $limit
     * @return object $this
     */
    public function set_limit($limit){
        $this->limit = $limit;
        return $this->limit;
    }

    public function get_result(){
        return array_slice($this->result,$this->offset,$this->limit);
    }

    public function get_search_text(){
        return Html::encode($this->text);
    }

    public function get_result_text(){
        return count($this->result) ? "Results for: <strong style='color:#ff9900;'>".Html::encode($this->text)."</strong>" : "<strong style='color:#ff9900;'>No result</strong>" ;
    }
}