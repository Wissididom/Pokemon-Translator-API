# Pokemon-Translator-API

### Examples

#### Translate "Evoli" into english with an english response

`{Base-URL}?name=evoli` -> `Your Pokemon's English name is "Eevee".`

`{Base-URL}?name=evoli&language=9` -> `Your Pokemon's English name is "Eevee".`

`{Base-URL}?name=evoli&language=9&outlang=9` -> `Your Pokemon's English name is "Eevee".`

`{Base-URL}?name=evoli&outlang=9` -> `Your Pokemon's English name is "Eevee".`

#### Translate "Evoli" into english with an german response

`{Base-URL}?name=evoli&outlang=6` -> `Der englische Name deines Pokemons lautet "Eevee".`

#### Translate "Eevee" into german with an german response

`{Base-URL}?name=eevee&language=6&outlang=6` -> `Der deutsche Name deines Pokemons lautet "Evoli".`

`{Base-URL}?name=eevee&language=6` -> `Der deutsche Name deines Pokemons lautet "Evoli".`

#### Translate "Eevee" into german with an english response

`{Base-URL}?name=eevee&language=6&outlang=9` -> `Your Pokemon's German name is "Evoli".`
