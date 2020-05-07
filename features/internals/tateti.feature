Feature: Funcionamiento del tateti
  Para poder jugar al Tateti
  Como un usuario del sistema
  Tengo que ser capaz de jugar al Tateti una libreria

  Scenario: Tateti inicial
 	Given que empiezo con un tateti
    When muestro el tablero
    Then verifico la cantidad de filas 
    And verifico la cantidad de columna   
    And verifico que el tablero este vacio
       
  Scenario: Jugar dos veces
 	Given que empiezo con un tateti
    When juego el simbolo "X" en la fila "0" y la columna "0"
    And juego el simbolo "O" en la fila "2" y la columna "0"   
    And muestro el tablero 
    Then verifico que hay un "X" en la fila "0" y la columna "0"
    And verifico que hay un "O" en la fila "2" y la columna "0"

  Scenario: Jugar simbolo invalido
 	Given que empiezo con un tateti
    When juego el simbolo "L" en la fila "0" y la columna "0"    
    And muestro el tablero
    Then  verifico que el tablero este vacio       

  Scenario: Jugar dos simbolos iguales consecutivamente
 	Given que empiezo con un tateti
    When juego el simbolo "X" en la fila "0" y la columna "0"    
    And juego el simbolo "X" en la fila "0" y la columna "0"  
    And muestro el tablero  
    Then verifico que hay un "X" en la fila "0" y la columna "0"

  Scenario: Jugar dos simbolos en la misma posicion
 	Given que empiezo con un tateti
    When juego el simbolo "X" en la fila "0" y la columna "0"    
    And juego el simbolo "O" en la fila "0" y la columna "0"    
    And muestro el tablero  
    Then verifico que hay un "X" en la fila "0" y la columna "0"

  Scenario: Verificar ganador en fila
 	Given que empiezo con un tateti
    When juego el simbolo "X" en la fila "0" y la columna "0"    
    And juego el simbolo "O" en la fila "2" y la columna "0"    
    And juego el simbolo "X" en la fila "0" y la columna "1"    
    And juego el simbolo "O" en la fila "2" y la columna "1"    
    And juego el simbolo "X" en la fila "0" y la columna "2"    
    And muestro el tablero 
    Then verifico que no gana en columna "0" el jugador "player1"
    And verifco que gana en la fila "0" el jugador "player1"
    
  Scenario: Verificar ganador en columna
 	Given que empiezo con un tateti
    When juego el simbolo "X" en la fila "0" y la columna "0"    
    And juego el simbolo "O" en la fila "0" y la columna "2"    
    And juego el simbolo "X" en la fila "1" y la columna "0"    
    And juego el simbolo "O" en la fila "1" y la columna "2"    
    And juego el simbolo "X" en la fila "2" y la columna "0"    
    And muestro el tablero
    Then verifico que no gana en fila "0" el jugador "player1"
    And verifco que gana en la columna "0" el jugador "player1"

  Scenario: Verificar ganador en diagonal
 	Given que empiezo con un tateti
    When juego el simbolo "X" en la fila "0" y la columna "0"    
    And juego el simbolo "O" en la fila "1" y la columna "0"    
    And juego el simbolo "X" en la fila "1" y la columna "1"    
    And juego el simbolo "O" en la fila "2" y la columna "0"    
    And juego el simbolo "X" en la fila "2" y la columna "2" 
    And muestro el tablero   
    Then verifico que no gana en fila "0" el jugador "player1"
    And verifico que no gana en columna "0" el jugador "player1"
    And verifco que gana en diagonal el jugador "player1"


