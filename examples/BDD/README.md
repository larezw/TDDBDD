BDD
===

https://dannorth.net/whats-in-a-story/
https://docs.behat.org/en/latest/quick_start.html


## Instalación

Para instalar Behat usaremos Composer

```bash
$ php composer.phar require behat/behat
```

Y una vez instalado necesitamos iniciar el proyecto para usar Behat

```bash
$ ./vendor/bin/behat --init
+d features/bootstrap - place your context classes here
+f features/bootstrap/FeatureContext.php - place your definitions,
transformations and hooks here
```

> FeatureContext es un objeto de contexto que recibira cada escenario al ser
> ejecutado. La idea es tener un objeto distinto para cada feature.

## Arrancando con BDD

Si no recordamos como se escriben las stories tenemos este comando de Behat
que nos muestra unos ejemplos de como escribirlos:

> ./vendor/bin/behat --story-syntax
> ./vendor/bin/behat --story-syntax  --lang=es

```
$ ./vendor/bin/behat --story-syntax
[Business Need|Feature|Ability]: Internal operations
  In order to stay secret
  As a secret organization
  We need to be able to erase past agents' memory

  Background:
    [Given|*] there is agent A
    [And|*] there is agent B

  [Scenario|Example]: Erasing agent memory
    [Given|*] there is agent J
    [And|*] there is agent K
    [When|*] I erase agent K's memory
    [Then|*] there should be agent J
    [But|*] there should not be agent K

  [Scenario Template|Scenario Outline]: Erasing other agents' memory
    [Given|*] there is agent <agent1>
    [And|*] there is agent <agent2>
    [When|*] I erase agent <agent2>'s memory
    [Then|*] there should be agent <agent1>
    [But|*] there should not be agent <agent2>

    [Scenarios|Examples]:
      | agent1 | agent2 |
      | D      | M      |
```

Si queremos escribirlas en algún idioma en particular podemos especificarle el
idioma y tendremos un ejemplo en dicho idioma.

> Es muy importante que el story tenga como primera linea el idioma
> \# language: es

```
$ ./vendor/bin/behat --story-syntax --lang=es
# language: es
Característica: Internal operations
  In order to stay secret
  As a secret organization
  We need to be able to erase past agents' memory

  Antecedentes:
    [Dados|Dadas|Dada|Dado|*] there is agent A
    [*|Y|E] there is agent B

  [Escenario|Ejemplo]: Erasing agent memory
    [Dados|Dadas|Dada|Dado|*] there is agent J
    [*|Y|E] there is agent K
    [Cuando|*] I erase agent K's memory
    [Entonces|*] there should be agent J
    [Pero|*] there should not be agent K

  Esquema del escenario: Erasing other agents' memory
    [Dados|Dadas|Dada|Dado|*] there is agent <agent1>
    [*|Y|E] there is agent <agent2>
    [Cuando|*] I erase agent <agent2>'s memory
    [Entonces|*] there should be agent <agent1>
    [Pero|*] there should not be agent <agent2>

    Ejemplos:
      | agent1 | agent2 |
      | D      | M      |
```

Los **Escenarios son ejemplos de acciones especificas** que puede realizar 
la feature. Por lo general se escriben en múltiples "Pasos", los cuales 
forman tres etapas del escenario.

Contexto, que comienza siempre con la palabra clave **Given** (**Dado** y
sus derivados en español).

Evento, que comienza siempre con la palabra clave **When** (**Cuando**).

Resultado, que comienza siempre con la palabra clave **Then** (**Entonces**).

Para encadenar múltiples pasos en una misma etapa se utilizan las palabras
clave **And** (**Y** o **E**), y **But** (**Pero**)

## Arrancar

A diferencia de TDD, cuando trabajamos con BDD las stories ya deben estar hechas
y listas para usar. En este ejemplo tendremos dos stories:
- features/agenda.feature
- features/phonebook.feature

> Todos los stories se guardaran dentro de la carpeta features que serán
> detectados automaticamente por Behat

> Es importante entender cuales son los componentes de cada story, por la cual
> es necesario leer lo siguiente: https://dannorth.net/whats-in-a-story/

Uno en español y el otro en ingles simplemente para tener ambos casos.

Uno de los conceptos que tendremos que tener en cuenta es que cada feature va a
ser ejecutado con una instancia de contexto. Este objeto será quien tendrá todos
los metodos necesarios para correr cada uno de los aspectos de la story. Y otro
detalle importante es que se hara una instancia de contexto nuevo para cada
escenario que se vaya a ejecutar.

Behat trae por defecto el objeto de contexto "FeatureContext", si necesitamos más
vamos a tener que crearlos.

Acá tenemos configurado varios contextos en el archivo behat.yml

```yml
default:
    suites:
        default:
            contexts:
                - FeatureContext
                - AgendaFeatureContext
                - PhoneBookFeatureContext
```

Si corremos

> ./vendor/bin/behat

Va a detectar las stories, va a confirmar si los pasos de cada escenario existe
dentro de un contexto, al no estarlo nos va a preguntar en que contexto nos
gustaría que esten y al seleccionar el contexto nos va a sugerir el código PHP
necesario para implementar dichos pasos

```bash

$ vendor/bin/behat 
Característica: Agenda de contactos
  Para poder tener una lista de contactos
  Como un usuario del sistema
  Tengo que ser capaz de agregar, quitar y actualizar contactos de mi agenda

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia
    Cuando listo los contactos
    Entonces obtengo 0 contactos

  Escenario: Agregando un contacto                                          # features/agenda.feature:12
    Dado que la agenda esta vacia
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234"
    Y listo los contactos
    Entonces obtengo 1 contactos
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234"

[...]

6 scenarios (6 undefined)
34 steps (34 undefined)
0m0.03s (8.51Mb)

 >> default suite has undefined steps. Please choose the context to generate snippets:

  [0] None
  [1] FeatureContext
  [2] AgendaFeatureContext
  [3] PhoneBookFeatureContext
 > 2

--- AgendaFeatureContext has missing steps. Define them with these snippets:

    /**
     * @Given que la agenda esta vacia
     */
    public function queLaAgendaEstaVacia()
    {
        throw new PendingException();
    }

    /**
     * @When listo los contactos
     */
    public function listoLosContactos()
    {
        throw new PendingException();
    }

    [...]
```

Ese código PHP podemos copiarlo y pegarlo en dicha clase de contexto o podemos
pedirle a Behat que los agregue automaticamente con el siguiente comando

> ./vendor/bin/behat --dry-run --append-snippets

Nos va a preguntar nuevamente en que archivo de contexto vamos a querer los
metodos y los va a agregar automaticamente y veremos una salida similar a esta:

```bash
$ vendor/bin/behat --dry-run --append-snippets
Característica: Agenda de contactos
  Para poder tener una lista de contactos
  Como un usuario del sistema
  Tengo que ser capaz de agregar, quitar y actualizar contactos de mi agenda

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia
    Cuando listo los contactos
    Entonces obtengo 0 contactos

  Escenario: Agregando un contacto                                          # features/agenda.feature:12
    Dado que la agenda esta vacia
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234"
    Y listo los contactos
    Entonces obtengo 1 contactos
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234"

  [...]

6 scenarios (6 undefined)
34 steps (34 undefined)
0m0.02s (8.36Mb)

 >> default suite has undefined steps. Please choose the context to generate snippets:

  [0] None
  [1] FeatureContext
  [2] AgendaFeatureContext
  [3] PhoneBookFeatureContext
 > 2

u features/bootstrap/AgendaFeatureContext.php - `que la agenda esta vacia` definition added
u features/bootstrap/AgendaFeatureContext.php - `listo los contactos` definition added
u features/bootstrap/AgendaFeatureContext.php - `obtengo 0 contactos` definition added
u features/bootstrap/AgendaFeatureContext.php - `agrego el contacto "Pepe Ventilete" con el telefono "1512341234"` definition added
u features/bootstrap/AgendaFeatureContext.php - `uno de los contactos es "Pepe Ventilete" con el telefono "1512341234"` definition added
u features/bootstrap/AgendaFeatureContext.php - `que la agenda tiene los siguientes contactos:` definition added
u features/bootstrap/AgendaFeatureContext.php - `se borra el contacto "Carlos"` definition added
u features/bootstrap/AgendaFeatureContext.php - `el contacto "Carlos" no existe` definition added
u features/bootstrap/AgendaFeatureContext.php - `edito el telefono del contacto "Jose" por "1511112222"` definition added
```

Listo, ya tenemos el código necesario para empezar a programar :D

## Paso 1

Ahora veremos que tenemos el archivo 'features/bootstrap/AgendaFeatureContext.php'
con los metodos correspondientes a cada paso de las story que acabamos de
agregar. La idea ahora es ir programando cada parte de esos pasos y luego ir
ejecutando los tests para que fallen e ir programando el código correspondiente.

Veamos el constructor del contexto

```php
/**
 * Defines application features from the specific context.
 */
class AgendaFeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct() {
        
    }

    //... hay muchos metodos mas

}
```

Cada escenario dentro de la story va a ser ejecutado de forma separada a los
demas escenarios, por lo cual Behat va a construir una instancia de este
contexto nueva para cada escenario que vaya a ejecutar. Teniendo en cuenta esto
este constructor nos permitira ejecutar alguna parte común a todos los
escenarios. Por ahora lo dejamos vacio.

Ahora en este momento si ejecutamos los tests nada debería fallar porque no
implementamos nada aún pero debería darnos información sobres las stories

```bash
$ vendor/bin/behat 
Característica: Agenda de contactos
  Para poder tener una lista de contactos
  Como un usuario del sistema
  Tengo que ser capaz de agregar, quitar y actualizar contactos de mi agenda

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
      TODO: write pending definition
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 0 contactos

  Escenario: Agregando un contacto                                          # features/agenda.feature:12
    Dado que la agenda esta vacia                                           # AgendaFeatureContext::queLaAgendaEstaVacia()
      TODO: write pending definition
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234" # AgendaFeatureContext::agregoElContactoConElTelefono()
    Y listo los contactos                                                   # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 1 contactos                                            # AgendaFeatureContext::obtengoContactos()
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234"
    [...]

6 scenarios (6 pending)
34 steps (6 pending, 28 skipped)
0m0.03s (8.53Mb)
```

Ahora nos dice que tenemos 6 escenarios (6 sin poder ejecutarse), 34 pasos de
los cuales 6 estan pendientes de implementar y 28 que no se evaluaron porque
dependen de esos que no se implementaron.

Behat cuando corremos los tests tambien nos muestra el orden en que ejecuta
los escenarios y no dice que cosas nos falta implementar así que hagamosle caso
y vayamos en el orden que nos muestra. El primer escenario que nos muestra es:

```
  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
      TODO: write pending definition
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 0 contactos
```

Y nos dice que el paso **Dado que la agenda esta vacia** nos falta definirlo,
programemos este paso:

> Vamos a ver que las stories las escribimos en español pero en el código vamos
> a encontrar los keywords en ingles, una tabla de equivalencia (probablemente
> incompleta es la siguiente)
> 
>   Feature  => Característica
>   Scenario => Escenario
>   Given    => Dado
>   When     => Cuando
>   But      => Pero
>   Then     => Entonces
>   And      => Y

```php
// features/bootstrap/AgendaFeatureContext.php
    /**
     * @Given que la agenda esta vacia
     */
    public function queLaAgendaEstaVacia()
    {
        $this->phonebook = new \Capacitacion\PhoneBook();
    }
```

Ahora si ejecutamos los tests veremos que falla al igual que lo hacíamos en TDD

```bash
$ vendor/bin/behat
$ vendor/bin/behat 
Característica: Agenda de contactos
  Para poder tener una lista de contactos
  Como un usuario del sistema
  Tengo que ser capaz de agregar, quitar y actualizar contactos de mi agenda

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
      Fatal error: Class 'Capacitacion\PhoneBook' not found (Behat\Testwork\Call\Exception\FatalThrowableError)
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 0 contactos  # AgendaFeatureContext::obtengoContactos()

  Escenario: Agregando un contacto                                          # features/agenda.feature:12
PHP Fatal error:  Cannot declare class Capacitacion\PhoneBook1, because the name is already in use in /Users/dario/Projects/TDD/BDD/src/PhoneBook.php on line 5

Fatal error: Cannot declare class Capacitacion\PhoneBook1, because the name is already in use in /Users/dario/Projects/TDD/BDD/src/PhoneBook.php on line 5
```

Bueno, no existe la clase, entonces la creamos

```php
<?php // src/PhoneBook.php
namespace Capacitacion;

class PhoneBook {
}
```

Volvemos a correr los tests

```bash
$ vendor/bin/behat 
Característica: Agenda de contactos
  Para poder tener una lista de contactos
  Como un usuario del sistema
  Tengo que ser capaz de agregar, quitar y actualizar contactos de mi agenda

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
      TODO: write pending definition
    Entonces obtengo 0 contactos 

    [...]

6 scenarios (6 pending)
34 steps (3 passed, 6 pending, 25 skipped)
0m0.13s (8.53Mb)
```

Bueno, dejo de fallar que era nuestro objetivo. También podemos ver que ahora
hay 3 pasos que passan los tests, esto es porque este paso se usa en varios
escenarios, lo cual ya avanzamos un monton, yay!

## Paso 2

Como vimos en el paso anterior implementamos un paso y nos sigue sugiriendo que
cosas nos falta, lo cual sigamos en el orden que nos dice

```
Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
      TODO: write pending definition
    Entonces obtengo 0 contactos
```

Nos dice que nos falta el paso **Cuando listo los contactos**, vayamos a
implementar este paso

```php
// features/bootstrap/AgendaFeatureContext.php
    /**
     * @When listo los contactos
     */
    public function listoLosContactos()
    {
        $this->contacts = $this->phonebook->list();
    }
```

Corremos los tests como siempre

```bash
$ vendor/bin/behat 
Característica: Agenda de contactos
  Para poder tener una lista de contactos
  Como un usuario del sistema
  Tengo que ser capaz de agregar, quitar y actualizar contactos de mi agenda

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
      Fatal error: Call to undefined method Capacitacion\PhoneBook::list() (Behat\Testwork\Call\Exception\FatalThrowableError)
    Entonces obtengo 0 contactos

    [...]

--- Failed scenarios:

    features/agenda.feature:7

6 scenarios (1 failed, 5 pending)
34 steps (3 passed, 1 failed, 5 pending, 25 skipped)
0m0.03s (8.56Mb)
```
Vemos que falla porque no existe el metodo que lista los contactos en la clase.
Entonces implementamos dicho metodo en la clase

```php
class PhoneBook {
    public function list() {
        return array();
    }
}
```

Ahora corremos de nuevo los tests para verificar que los pasamos

```bash
[...]

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 0 contactos  # AgendaFeatureContext::obtengoContactos()
      TODO: write pending definition

[...]

6 scenarios (6 pending)
34 steps (4 passed, 6 pending, 24 skipped)
0m0.03s (8.53Mb)
```

## Paso 3

En lo último que hicimos nos falto el paso **Entonces obtengo 0 contactos** . Acá
es donde empezamos a asegurar cosas (chequear/asserting) de nuestro código. Si
prestamos atención aún no escribimos ningún assert y esto es raro, no estamos
creando tests? Bueno, en BDD describimos comportamientos de una forma un poco
más abstracta que en TDD y lo que hicimos hasta ahora fue implementar pasos
previos y necesarios al punto donde vamos a asegurar/assert cosas. Los chequeos
se van a realizar siempre en los pasos **Entonces** o **Then** en ingles. Estos
pasos tendrán dentro chequeos de las cosas que fuimos haciendo.

> Behat no trae con sigo mismo un sistema de assert como PHPUnit. Lo que hay que
> usar es cualquier librería para esta funcionalidad, por simplicidad usaremos
> PHPUnit porque ya estamos familiarizados con esta, pero podría ser cualquier
> otra librería que asegure/assert y al fallar tire excepciones.

Implementemos este paso

```php
// features/bootstrap/AgendaFeatureContext.php
    /**
     * @Then obtengo :arg1 contactos
     */
    public function obtengoContactos($arg1)
    {
        \PHPUnit\Framework\Assert::assertEquals(
            intval($arg1),
            count($this->contacts)
        );
    }
```

Ahora corremos los tests

```bash
[...]

  Escenario: Agenda vacia         # features/agenda.feature:7
    Dado que la agenda esta vacia # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando listo los contactos    # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 0 contactos 

  Escenario: Agregando un contacto                                          # features/agenda.feature:12
    Dado que la agenda esta vacia                                           # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234" # AgendaFeatureContext::agregoElContactoConElTelefono()
      TODO: write pending definition
    Y listo los contactos                                                   # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 1 contactos                                            # AgendaFeatureContext::obtengoContactos()
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234" 
[...]

6 scenarios (1 passed, 5 pending)
34 steps (5 passed, 5 pending, 24 skipped)
0m0.04s (8.81Mb)
```

Ya no nos marca ningún problema con el primer escenario (en la consola lo marca
todo en verde) y ya tenemos la confirmación de que 1 de los 6 escenarios corre
bien.

A diferencia de los pasos anteriores, este es normal que no falle con un fatal
error porque la parte donde se implementan nuevos metodos normalmente surgen en
los pasos anteriores y en este (normalmente) solo se aseguran cosas de lo
anteriormente implementado. Lo que va a suceder en este paso es que las cosas
que aseguramos no sean ciertas porque nuestro código esta hardcodeado.

Durante la implementación de este último paso podemos ver como la clase de contexto
puede extraer datos de los pasos escritos en las escenas para usarlos como parámetros.
La clase toma como datos cosas como números y cadenas entre comillas ("").

Aunque sobre este último metodo veamos una escritura mas genérica del paso a probar,
debemos recordar que, en nuestras stories, las escenas se escriben como **ejemplos específicos**.

## Paso 4

En la corrida anterior, el primer escenario estaba bien pero el siguiente le
faltaban cosas.

```
  Escenario: Agregando un contacto                                          # features/agenda.feature:12
    Dado que la agenda esta vacia                                           # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234" # AgendaFeatureContext::agregoElContactoConElTelefono()
      TODO: write pending definition
    Y listo los contactos                                                   # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 1 contactos                                            # AgendaFeatureContext::obtengoContactos()
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234" 
```

Implementemos el paso **Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234"**

```php
    /**
     * @When agrego el contacto :arg1 con el telefono :arg2
     */
    public function agregoElContactoConElTelefono($arg1, $arg2)
    {
        $this->phonebook->add($arg1, $arg2);
    }
```

Si corremos los tests tendremos el fatal error de que el metodo add no existe
en el objeto PhoneBook. Lo agregamos

> Los output de correr los tests y que fallen no se incluirán de aquí en
> adelante por ser redundantes salvo que aporten información nueva o de interes
> para explicación

```php
    // agregamos una propiedad privada al objeto
    private $contacts = array();

    public function add($nombre, $telefono) {
        $this->contacts[$nombre] = $telefono;
    }
```

> Por simplicidad acá salteo el caso de dejarlo vacío y esperar que falle en el
> próximo paso. En la clase presencial lo haría completamente

Ahora al correr los tests obtendremos

```bash
[...]

  Escenario: Agregando un contacto                                          # features/agenda.feature:12
    Dado que la agenda esta vacia                                           # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234" # AgendaFeatureContext::agregoElContactoConElTelefono()
    Y listo los contactos                                                   # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 1 contactos                                            # AgendaFeatureContext::obtengoContactos()
      Failed asserting that 0 matches expected 1.
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234" # AgendaFeatureContext::unoDeLosContactosEsConElTelefono()

  Escenario: Agregando varios contactos                           # features/agenda.feature:19
    Dado que la agenda esta vacia                                 # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando agrego el contacto "Juan" con el telefono "1556785678" # AgendaFeatureContext::agregoElContactoConElTelefono()
    Y agrego el contacto "Jose" con el telefono "1512341234"      # AgendaFeatureContext::agregoElContactoConElTelefono()
    Y agrego el contacto "Carlos" con el telefono "1512345678"    # AgendaFeatureContext::agregoElContactoConElTelefono()
    Y listo los contactos                                         # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 3 contactos                                  # AgendaFeatureContext::obtengoContactos()
      Failed asserting that 0 matches expected 3.

[...]
```

Y aquí tendremos ambos errores que esperaríamos que pasen

```
      Failed asserting that 0 matches expected 1.

      Failed asserting that 0 matches expected 3.
```

Esto es porque el metodo list de PhoneBook sigue hardcodeado. Arreglemos eso:

```php
    public function list() {
        return $this->contacts;
    }
```

Corremos los tests y ahora veremos

```bash
[...]
6 scenarios (2 passed, 4 pending)
35 steps (13 passed, 4 pending, 18 skipped)
0m0.04s (8.81Mb)
```

Que dos escenarios estan corriendo bien, pero el nuevo escenario que corre bien
no era el segundo, en el que estabamos trabajando. Esto se debe que completamos
los pasos de otro escenario pero el segundo escenario que era el que estabamos
trabajando todavía depende de otros pasos aún no hechos.

## Paso 5

En nuestro última corrida obtuvimos esta información del segundo escenario

```bash
  Escenario: Agregando un contacto                                          # features/agenda.feature:12
    Dado que la agenda esta vacia                                           # AgendaFeatureContext::queLaAgendaEstaVacia()
    Cuando agrego el contacto "Pepe Ventilete" con el telefono "1512341234" # AgendaFeatureContext::agregoElContactoConElTelefono()
    Y listo los contactos                                                   # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 1 contactos                                            # AgendaFeatureContext::obtengoContactos()
    Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234" # AgendaFeatureContext::unoDeLosContactosEsConElTelefono()
      TODO: write pending definition
```

Todavía nos falta el paso **Y uno de los contactos es "Pepe Ventilete" con el telefono "1512341234"**

```php
    /**
     * @Then uno de los contactos es :arg1 con el telefono :arg2
     */
    public function unoDeLosContactosEsConElTelefono($arg1, $arg2)
    {
        \PHPUnit\Framework\Assert::assertTrue(
            key_exists($arg1, $this->contacts)
        );
        \PHPUnit\Framework\Assert::assertEquals(
            $arg2,
            $this->contacts[$arg1]
        );
    }
```

Al correr los tests veremos que no falla lo cual esta bien dado que esta
funcionalidad lo implementamos antes.

```bash
[...]

6 scenarios (3 passed, 3 pending)
35 steps (14 passed, 3 pending, 18 skipped)
0m0.04s (8.82Mb)
```

Ya tenemos 3 escenarios completos y solo faltan 3 más.

## Paso 6

El próximo escenario a revisar es el siguiente

```bash
  Escenario: Eliminando un contacto                                # features/agenda.feature:27
    Dado que la agenda tiene los siguientes contactos:             # AgendaFeatureContext::queLaAgendaTieneLosSiguientesContactos()
      | nombre | telefono   |
      | Jose   | 1512341234 |
      | Carlos | 1556785678 |
      | Juana  | 1512345678 |
      TODO: write pending definition
    Cuando se borra el contacto "Carlos"                           # AgendaFeatureContext::seBorraElContacto()
    Y listo los contactos                                          # AgendaFeatureContext::listoLosContactos()
    Entonces obtengo 2 contactos                                   # AgendaFeatureContext::obtengoContactos()
    Y uno de los contactos es "Jose" con el telefono "1512341234"  # AgendaFeatureContext::unoDeLosContactosEsConElTelefono()
    Y uno de los contactos es "Juana" con el telefono "1512345678" # AgendaFeatureContext::unoDeLosContactosEsConElTelefono()
    Pero el contacto "Carlos" no existe 
```

Y nos marca que el paso **Dado que la agenda tiene los siguientes contactos:**
no esta implementado.

```php
    /**
     * @Given que la agenda tiene los siguientes contactos:
     */
    public function queLaAgendaTieneLosSiguientesContactos(TableNode $table)
    {
        $this->phonebook = new \Capacitacion\PhoneBook();
        
        foreach ($table as $row) {
            $this->phonebook->add($row['nombre'], $row['telefono']);
        }
    }
```

En este caso estabamos haciendo un paso **Given** o **Dado** por lo cual en este
paso procuramos generar todos los elementos necesarios para poder ejecutar los
próximos pasos, es por eso que es necesario crear el objeto PhoneBook en este
paso.

Al correr los tests veremos que ahora corren 3 pasos más que antes pero siguen
la misma cantidad de escenarios sin correr.

## Paso 7

El próximo escenario a arreglar nos dice que falta implementar el paso
**Cuando se borra el contacto "Carlos"**

```php
    /**
     * @When se borra el contacto :arg1
     */
    public function seBorraElContacto($arg1)
    {
        $this->phonebook->remove($arg1);
    }
```

Si corremos los tests tenemos un fatal error que nos dice que el metodo "remove"
no existe en PhoneBook, entonces lo agregamos.

```php
    public function remove($nombre) {
        unset($this->contacts[$nombre]);
    }
```

> Por simplicidad omití los pasos de agregarlo vacío el método y que falle en
> otro tests, en clase hay que hacerlo

Ahora si corremos los tests

```bash
[...]

6 scenarios (3 passed, 3 pending)
35 steps (27 passed, 3 pending, 5 skipped)
0m0.05s (8.82Mb)
```

Ahora pasan casi todos los pasos pero seguimos con 3 escenarios incompletos,
pero ya estamos cerca.

## Paso 8

Ahora nos marca que falta el paso **Pero el contacto "Carlos" no existe**

```php
    /**
     * @Then el contacto :arg1 no existe
     */
    public function elContactoNoExiste($arg1)
    {
        \PHPUnit\Framework\Assert::assertArrayNotHasKey($arg1, $this->contacts);
    }
```

Al correr los tests

```bash
[...]

6 scenarios (5 passed, 1 pending)
35 steps (31 passed, 1 pending, 3 skipped)
0m0.05s (8.83Mb)
```

## Paso 9

Ahora nos marca que nos falta el paso **Cuando edito el telefono del contacto "Jose" por "1511112222"**

```php
    /**
     * @When edito el telefono del contacto :arg1 por :arg2
     */
    public function editoElTelefonoDelContactoPor($arg1, $arg2)
    {
        $this->phonebook->edit($arg1, $arg2);
    }
```

Nos falta el método edit en PhoneBook

```php
// src/Phonebook.php

    public function edit($nombre, $telefono) {
        if (isset($this->contacts[$nombre])){
            $this->contacts[$nombre] = $telefono;
        }
    }
```

Y ahora si corremos los tests veremos

```bash
[...]

6 scenarios (6 passed)
35 steps (35 passed)
0m0.06s (8.82Mb)
```

Y ahí terminamos :D

## Conclusiones

En BDD se hace uso extensivo de la descripción del comportamiento de nuestra
aplicación. A diferencia de TDD, los tests estan basados en descripciones que
nos vienen ya dadas y que debemos lograr implementar. Unas de las ventajas de
BDD es que vamos a ir programando e implementando partes chicas de comportamiento
que se irán usando en muchos escenarios distintos por lo cual con cada paso/step
que implementemos estaremos implementando parte de muchos escenarios y de esta
forma favorecer la reutilización de dichos pasos en otros escenarios.