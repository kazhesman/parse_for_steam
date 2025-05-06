<?php
include 'simple_html_dom.php';
include 'getinfo.php';

$pagescanamount = 10;
for ($i=0; $i < $pagescanamount; $i++) { 
   $htmlpage10skins = file_get_html('https://steamcommunity.com/market/search?q=&category_730_ItemSet%5B%5D=any&category_730_ProPlayer%5B%5D=any&category_730_StickerCapsule%5B%5D=any&category_730_Tournament%5B%5D=any&category_730_TournamentTeam%5B%5D=any&category_730_Type%5B%5D=tag_CSGO_Type_Rifle&category_730_Weapon%5B%5D=any&category_730_Rarity%5B%5D=tag_Rarity_Rare_Weapon&category_730_Rarity%5B%5D=tag_Rarity_Uncommon_Weapon&category_730_Rarity%5B%5D=tag_Rarity_Mythical_Weapon&category_730_Rarity%5B%5D=tag_Rarity_Legendary_Weapon&category_730_Rarity%5B%5D=tag_Rarity_Ancient_Weapon&appid=730#p' . $i .'_popular_desc');
   $skininfo = [];
   // for ($i=0; $i < 10; $i++) { 
   //    $skininfo[] = file_get_html($htmlpage10skins->find('.market_listing_row_link')[$i]->href);
   // }
   for ($i=0; $i < 10; $i++) { 
      $skininfo[] = analyze_skin(
      $htmlpage10skins->find('.market_listing_row_link')[$i]->href,
      $htmlpage10skins->find('.market_listing_item_name')[$i]->plaintext,
      0.6
   );
   }
}

print_r($skininfo);



// $h = fopen("index.html","w+");
// if (fwrite($h, $skininfo)) 
//    echo "1"; 
// else 
//    echo "0";

// $content = file_get_contents("index.html");
// echo $content;
// preg_match_all('/\[\[(.*?)\]\]/', $сontent, $matches);
// echo 0;

function ignorewaste($monthpricehistory, $averageprice) {
   for ($i=0; $i < count($monthpricehistory); $i++) { 
      if($averageprice * 1.9 < $monthpricehistory[$i][1]){
         unset($monthpricehistory[$i]);
      }
   }
   return [$monthpricehistory, $averageprice];
}

function profitsearch($arr, $diff) {
   [$monthpricehistory, $averageprice] = [$arr[0], $arr[1]];
   // Вычисляем границы 7% отклонения
   $lowerLimit = $averageprice * (1 - $diff); // 93% от среднего
   $upperLimit = $averageprice * (1 + $diff); // 107% от среднего
   
   // Проверяем массив на соответствие условиям
   $found = false; // Флаг, если значение найдено
   
   foreach ($monthpricehistory as $price) {
       if ($price < $lowerLimit || $price > $upperLimit) {
           $found = true;
           break; // Достаточно найти хотя бы одно значение
       }
   }
   return $found;
   }


function analyze_skin($skinlink, $name, $diff) { 

// Чтение содержимого файла index.html
$fileContent = file_get_contents($skinlink);
// $fileContent = file_get_contents('https://steamcommunity.com/market/listings/730/FAMAS%20%7C%20Teardown%20%28Well-Worn%29'); // Замените на путь к файлу

// Создание объекта DOMDocument
$dom = new DOMDocument();

// Отключение предупреждений об ошибках при загрузке HTML
libxml_use_internal_errors(true);

// Загрузка HTML контента
$dom->loadHTML($fileContent);

// Включение отображения ошибок
libxml_clear_errors();

// Получение всех тегов <script>
$scripts = $dom->getElementsByTagName('script');

// Массив для хранения найденных строк
$matches = [];

// Регулярное выражение для поиска строк, начинающихся с [[ и заканчивающихся на ]]
$pattern = '/\[\[.*\]\]/';

// Перебор всех тегов <script>
foreach ($scripts as $script) {
    $scriptContent = $script->nodeValue; // Получаем текст из тега <script>
    
    // Ищем совпадения в тексте
    preg_match_all($pattern, $scriptContent, $scriptMatches);
    
    // Добавляем найденные строки в общий массив
    $matches= array_merge($matches, $scriptMatches[0]);
}

// Вывод найденных строк
$pricehistory = json_decode($matches[0], true);
// end($pricehistory);


$pattern = '/^[a-zA-Zа-яА-ЯёЁ]{3}/';
$monthpricehistory[] = end($pricehistory);
preg_match($pattern, current($pricehistory)[0], $matches1);
prev($pricehistory);
$fr = preg_match($pattern, current($pricehistory)[0]);

for ($i=0; $i < 50; $i++) {
   preg_match($pattern, current($pricehistory)[0], $matches2);
   if($matches2[0] == $matches1[0]) {
      $monthpricehistory[] = current($pricehistory);
      prev($pricehistory);
   }
   else {
      $i = 50;
   }
}
   $allmonthprices = [];
   for ($i=0; $i < count($monthpricehistory); $i++) { 
      $allmonthprices[] = $monthpricehistory[$i][1];
   }
   $averageprice = array_sum($allmonthprices) / count($monthpricehistory);

// print_r($monthpricehistory);
// $ignoredmonthpricehistory = [];




  if(profitsearch(ignorewaste($monthpricehistory, $averageprice), $diff)) {
      // $sc = file_get_contents($skinlink);
      preg_match('/Market_LoadOrderSpread\(\s*(\d+)\s*\)/', $fileContent, $matches);
      return getdata($skinlink, $name, $matches[1]);
  }
}




