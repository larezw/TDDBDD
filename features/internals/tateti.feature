Feature: Funcionamiento del tateti
  Para poder jugar al Tateti
  Como un usuario del sistema
  Tengo que ser capaz de jugar al Tateti una libreria

  Scenario: Tateti inicial
 	Given que empiezo con un tateti
    When creo el tablero
    Then obtengo la cantidad de filas 3
    And obtengo la cantidad de columna 3    

  Scenario: Tateti inicial
 	Given que empiezo con un tateti y muestro el tablero
    When creo el tablero 
    And  muestro el tableto
    Then obtengo la matriz []
    



