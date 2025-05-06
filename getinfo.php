<?php 
// include 'simple_html_dom.php';

function getdata ($skinlink, $skinname, $id) { 
// $content = file_get_html($skinlink);

// записать в файл чтобы не багалось
// $h = fopen("result.html", "w+");
// fwrite($h, $content);
// https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Buzz%20Kill%20%28Field-Tested%29

// $min = $content->find('market_listing_item_name_block');
// $buyorder = $content->find('#market_commodity_buyrequests')[1]->plaintext; //1count 2price
// $buyordertable = $content->find('.market_commodity_orders_table')[1]->plaintext;

// не работает поэтому получаем с json

// Регулярка для поиска ID
// $sc = $content->find('script')[27];

// $sc = file_get_contents($skinlink);
// preg_match('/Market_LoadOrderSpread\(\s*(\d+)\s*\)/', $sc, $matches);
$data = file_get_contents('https://steamcommunity.com/market/itemordershistogram?country=DE&language=english&currency=1&item_nameid='. $id);
$arr = json_decode($data);

// выдать data для массива highest_buy_order lowest_sell_order
// $name = $content->find('.market_listing_nav a')[1]->plaintext;
$name = $skinname;
// $formatted = number_format($arr->lowest_sell_order, 3, '', '.');
$pos = strlen($arr->lowest_sell_order) - 2;
$str = substr($arr->lowest_sell_order, 0, $pos) . '.' . substr($arr->lowest_sell_order, $pos);
$price = "Цена: ". $str;
// $diff = "</br>Разница BO/min: " . (17.83 / (14.43 / 100)) - 100 . '%';
$diff = "</br>Разница BO/min: " . ($arr->lowest_sell_order / ($arr->highest_buy_order / 100)) - 100 . '%';
$link = $skinlink;
// $link = "/skin.com";
// echo "name"
// echo "</br>Цена: " . $content->find('.market_listing_price.market_listing_price_with_fee')[0]->plaintext; 
// echo "</br>Разница BO/min: " . '1%'; 
// echo "</br>" . $content->find('.market_listing_nav a')[1]->href;
   return [$name, $price, $diff, $link];
}