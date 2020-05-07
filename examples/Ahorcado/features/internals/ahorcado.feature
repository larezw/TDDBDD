# language: es
Característica: Funcionamiento del ahorcado
  Para poder jugar al Ahorcado
  Como un usuario del sistema
  Tengo que ser capaz de jugar al Ahorcado una libreria

  Escenario: Ahorcado inicial
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando muestro la palabra
    Entonces obtengo la cadena "___________"

  Escenario: Ahorcado inicial con otra palabra
    Dado que empiezo con un ahorcado con la palabra "Terraria"
    Cuando muestro la palabra
    Entonces obtengo la cadena "________"

  Escenario: Juego una letra que es parte de la palabra
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "a"
    Y muestro la palabra
    Entonces obtengo la cadena "____a______"
  
  Escenario: Juego varias letras que son parte de la palabra
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "a"
    Y juego la letra "b"
    Y juego la letra "s"
    Y muestro la palabra
    Entonces obtengo la cadena "___ba____ss"
  
  Escenario: Juego una letra que no es parte de la palabra
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "z"
    Y muestro la palabra
    Entonces obtengo la cadena "___________"
  
  Escenario: Juego dos letras que no son parte de la palabra
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "z"
    Y juego la letra "x"
    Y muestro la palabra
    Entonces obtengo la cadena "___________"
  
  Escenario: Juego todas las letras correctas
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "b"
    Y juego la letra "a"
    Y juego la letra "h"
    Y juego la letra "i"
    Y juego la letra "t"
    Y juego la letra "s"
    Y muestro la palabra
    Entonces obtengo la cadena "GlobalHitss"

  Escenario: Juego y hay intentos restante
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Entonces tengo 5 intenos disponibles

  Escenario: Juego unas letras que estan y los intentos no varian
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y muestro la palabra
    Entonces tengo 5 intenos disponibles
    Y obtengo la cadena "Glo__l_____"

  Escenario: Juego una letra que no esta y los intentos bajan
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "z"
    Y muestro la palabra
    Entonces tengo 4 intenos disponibles
    Y obtengo la cadena "Glo__l_____"

  Escenario: Juego letras que no estan y los intentos bajan
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "z"
    Y juego la letra "x"
    Y juego la letra "y"
    Y muestro la palabra
    Entonces tengo 2 intenos disponibles
    Y obtengo la cadena "Glo__l_____"

  Escenario: Juego letras que no estan y me quedo sin intentos
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "z"
    Y juego la letra "x"
    Y juego la letra "y"
    Y juego la letra "w"
    Y juego la letra "r"
    Y muestro la palabra
    Entonces tengo 0 intenos disponibles
    Y obtengo la cadena "Glo__l_____"

  Escenario: Al empezar a jugar me dice que no gane aun
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Entonces no gane

  Escenario: Juego letras que estan y que no estan pero todavia no gane
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "z"
    Y juego la letra "x"
    Y juego la letra "y"
    Y muestro la palabra
    Entonces tengo 2 intenos disponibles
    Y obtengo la cadena "Glo__l_____"
    Pero no gane

  Escenario: Juego todas las letra y gano
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "b"
    Y juego la letra "a"
    Y juego la letra "h"
    Y juego la letra "i"
    Y juego la letra "t"
    Y juego la letra "s"
    Y muestro la palabra
    Entonces tengo 5 intenos disponibles
    Y obtengo la cadena "GlobalHitss"
    Y gane

  Escenario: El juego me dice si se termino o no
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Entonces el juego no termino

  Escenario: Jugue algunas letras y el juego aun no termino
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "z"
    Y juego la letra "x"
    Y juego la letra "y"
    Entonces tengo 2 intenos disponibles
    Pero no gane
    Y el juego no termino

  Escenario: El juego me dice que termine cuando no tengo mas intentos
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando me quedo sin intentos
    Entonces el juego termino

  Escenario: El juego me dice que termine cuando no tengo mas intentos
    Dado que empiezo con un ahorcado con la palabra "GlobalHitss"
    Cuando y jugue todas las letras correctas
    Entonces el juego termino

  