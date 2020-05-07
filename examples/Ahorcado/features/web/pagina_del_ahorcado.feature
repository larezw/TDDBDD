# language: es
Característica: Ahorcado web
  Para poder jugar al Ahorcado
  Como usuario de la pagina web
  Tengo que ser capaz de jugar al Ahorcado por medio del browser

  Escenario: Puedo entrar a la home de la aplicacion
    Dado que estoy en la página de inicio
    Entonces debo ver "Bienvenido al Ahorcado"

  Escenario: Al entrar a la home de la aplicacion puedo ver el formulario
    Dado que estoy en la página de inicio
    Entonces debo ver el formulario para empezar a jugar

  Escenario: Cuando entro en la home puedo poner la palabra con cual jugar
    Dado que estoy en la página de inicio
    Cuando pongo la palabra "GlobalHitss" para jugar
    Entonces llego a la pagina donde voy a jugar
    Y veo el abecedario para jugar las distintas letras
    Y debo ver "___________"

  Escenario: Empiezo a jugar y juego una letra
    Dado que estoy en la página de inicio
    Cuando pongo la palabra "GlobalHitss" para jugar
    Y juego la letra "a"
    Entonces debo ver "____a______"

  Escenario: Cuando juego varias letras las puedo ver completadas en la palabra
    Dado que estoy en la página de inicio
    Cuando pongo la palabra "GlobalHitss" para jugar
    Y juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "b"
    Y juego la letra "a"
    Entonces debo ver "Global_____"

  Escenario: Cuando juego todas las letras debería ver el cartel de ganador
    Dado que estoy en la página de inicio
    Cuando pongo la palabra "GlobalHitss" para jugar
    Y juego la letra "g"
    Y juego la letra "l"
    Y juego la letra "o"
    Y juego la letra "b"
    Y juego la letra "a"
    Y juego la letra "h"
    Y juego la letra "i"
    Y juego la letra "t"
    Y juego la letra "s"
    Entonces debo ver "GlobalHitss"
    Y debo ver "Ganaste!"

  Escenario: Cuando juego todas las letras equivocadas debería perder
    Dado que estoy en la página de inicio
    Cuando pongo la palabra "GlobalHitss" para jugar
    Y juego la letra "r"
    Y juego la letra "w"
    Y juego la letra "x"
    Y juego la letra "y"
    Y juego la letra "z"
    Entonces debo ver "GlobalHitss"
    Y debo ver "Perdiste"

  