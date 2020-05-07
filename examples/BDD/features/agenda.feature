# language: es
Característica: Agenda de contactos
  Para poder tener una lista de contactos
  Como un usuario del sistema
  Tengo que ser capaz de agregar, quitar y actualizar contactos de mi agenda

  Escenario: Agenda vacia
    Dado que la agenda esta vacia
    Cuando listo los contactos
    Entonces obtengo 0 contactos

  Escenario: Agregando un contacto
    Dado que la agenda esta vacia
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234"
    Y listo los contactos
    Entonces obtengo 1 contactos
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234"

  Escenario: Agregando varios contactos
    Dado que la agenda esta vacia
    Cuando agrego el contacto "Juan" con el telefono "1556785678"
    Y agrego el contacto "Jose" con el telefono "1512341234"
    Y agrego el contacto "Carlos" con el telefono "1512345678"
    Y listo los contactos
    Entonces obtengo 3 contactos

  Escenario: Eliminando un contacto
    Dado que la agenda tiene los siguientes contactos:
      | nombre | telefono   |
      | Jose   | 1512341234 |
      | Carlos | 1556785678 |
      | Juana  | 1512345678 |
    Cuando se borra el contacto "Carlos"
    Y listo los contactos
    Entonces obtengo 2 contactos
    Y uno de los contactos es "Jose" con el telefono "1512341234"
    Y uno de los contactos es "Juana" con el telefono "1512345678"
    Pero el contacto "Carlos" no existe

  Escenario: Eliminando todos los contactos
    Dado que la agenda tiene los siguientes contactos:
      | nombre | telefono   |
      | Jose   | 1512341234 |
      | Carlos | 1556785678 |
      | Juana  | 1512345678 |
    Cuando se borra el contacto "Jose"
    Y se borra el contacto "Carlos"
    Y se borra el contacto "Juana"
    Y listo los contactos
    Entonces obtengo 0 contactos
    Pero el contacto "Jose" no existe
    Y el contacto "Carlos" no existe
    Y el contacto "Juana" no existe

  Escenario: Actualizando un contacto
    Dado que la agenda tiene los siguientes contactos:
      | nombre | telefono   |
      | Jose   | 1512341234 |
      | Carlos | 1556785678 |
      | Juana  | 1512345678 |
    Cuando edito el telefono del contacto "Jose" por "1511112222"
    Y listo los contactos
    Entonces uno de los contactos es "Jose" con el telefono "1511112222"
    Y obtengo 3 contactos