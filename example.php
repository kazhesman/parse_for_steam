<?php
include 'simple_html_dom.php';
$foxtrot = file_get_html("https://www.foxtrot.com.ua/ru/shop/noutbuki.html");

$html = file_get_html('https://steamcommunity.com/sharedfiles/filedetails/?id=2462524188');
echo $html->find('#ActualMedia')[0];
$n  = $html->find('#ActualMedia')[0];
echo '<style> #ActualMedia { width: 200px; } </style>';

echo '</br>Количество понравившеся: ' . $html->find('#VotesUpCount')[0]->plaintext;
echo '</br>Количество коментариев: ' . $html->find('.ellipsis.commentthread_count_label span')[0]->plaintext;
echo '</br>Коментарий к илюстрации: ' . $html->find('.nonScreenshotDescription')[0]->plaintext;
echo '</br>Размер файла ' . $html->find('.detailsStatRight')[0]->plaintext;
echo '</br>Дата добавления ' . $html->find('.detailsStatRight')[1]->plaintext;
echo '</br>Размер ' . $html->find('.detailsStatRight')[2]->plaintext;

$authorinfo = file_get_html($html->find('.friendBlockLinkOverlay')[0]->href);
echo "</br>Данные автора</br>";
echo $authorinfo->find('.playerAvatarAutoSizeInner img')[1];
echo '</br>Имя автора ' . $authorinfo->find('.actual_persona_name')[0]->plaintext; 
echo '</br>Уровень автора ' . $authorinfo->find('.friendPlayerLevelNum')[0]->plaintext;

 $html->clear(); // подчищаем за собой
 unset($html);
 $authorinfo->clear(); // подчищаем за собой
 unset($authorinfo);
