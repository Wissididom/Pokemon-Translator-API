<?php
function csv2json($csv) {
    $data = array_map("str_getcsv", explode("\n", $csv));
    $columns = $data[0];
    $json = [];
    foreach ($data as $row_index => $row_data) {
        if($row_index === 0) continue;
        $json[$row_index] = [];
        foreach ($row_data as $column_index => $column_value) {
            $label = $columns[$column_index];
            $json[$row_index][$label] = $column_value;
        }
    }
    return $json;
}
$language = 9; // English
if (isset($_GET['language'])) $language = intval($_GET['language']);
if ($language > 10 || $language < 1) {
    http_response_code(400);
    echo "400 Bad Request - Invalid Language";
    die();
}
if (!isset($_GET['name'])) {
    http_response_code(400);
    echo "400 Bad Request - No Name Given";
    die();
}
$csv = file_get_contents('https://github.com/PokeAPI/pokeapi/raw/master/data/v2/csv/pokemon_species_names.csv');
$pokemons = csv2json($csv);
$pokemonFound = false;
$reply = '';
switch ($language) {
    case 1:
        $reply = "あなたのポケモンは見つかりませんでした!";
        break;
    case 2:
        $reply = "Anata no pokemon wa mitsukarimasendeshita!";
        break;
    case 3:
        $reply = "당신의 포켓몬을 찾을 수 없습니다!";
        break;
    case 4:
        $reply = "你的小精灵找不到了！";
        break;
    case 5:
        $reply = "Ton Pokemon n'a pas pu être trouvé !";
        break;
    case 6:
        $reply = "Dein Pokemon konnte nicht gefunden werden!";
        break;
    case 7:
        $reply = "¡Tu Pokemon no ha podido ser encontrado!";
        break;
    case 8:
        $reply = "Il tuo Pokemon non è stato trovato!";
        break;
    case 10:
        $reply = "Vašeho Pokémona se nepodařilo najít!";
        break;
    default: // 9
        $reply = "Your Pokemon couldn't be found!";
        break;
}
for ($i = 0; $i < count($pokemons); $i++) {
    if ($pokemonFound)
        break;
    if (strtolower($pokemons[$i]['name']) == strtolower($_GET['name'])) {
        for ($j = 0; $j < count($pokemons); $j++) {
            if ($pokemons[$i]['pokemon_species_id'] == $pokemons[$j]['pokemon_species_id'] && intval($pokemons[$j]['local_language_id']) == $language) {
                switch ($language) {
                    case 1:
                        $reply = sprintf("あなたのポケモンの日本語名は \"%s\" です。", $pokemons[$j]['name']);
                        break;
                    case 2:
                        $reply = sprintf("Anata no pokemon no nihongo-mei wa \"%s\" desu.", $pokemons[$j]['name']);
                        break;
                    case 3:
                        $reply = sprintf("포켓몬의 한국 이름은 \"%s\" 입니다.", $pokemons[$j]['name']);
                        break;
                    case 4:
                        $reply = sprintf("你的小精灵的中文名字是 \"%s\"。", $pokemons[$j]['name']);
                        break;
                    case 5:
                        $reply = sprintf("Le nom français de votre pokémon est \"%s\".", $pokemons[$j]['name']);
                        break;
                    case 6:
                        $reply = sprintf("Der deutsche Name deines Pokemons lautet \"%s\".", $pokemons[$j]['name']);
                        break;
                    case 7:
                        $reply = sprintf("El nombre en español de tu pokemon es \"%s\".", $pokemons[$j]['name']);
                        break;
                    case 8:
                        $reply = sprintf("Il nome italiano del tuo pokemon è \"%s\".", $pokemons[$j]['name']);
                        break;
                    case 10:
                        $reply = sprintf("České jméno vašeho pokémona je \"%s\".", $pokemons[$j]['name']);
                        break;
                    default: // 9
                        $reply = sprintf("The english name of your pokemon is \"%s\".", $pokemons[$j]['name']);
                        break;
                }
            }
        }
    }
}
echo $reply;
?>
