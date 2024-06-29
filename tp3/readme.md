## Índice
1. [jugadorApiController](#documentación-jugadorApiController)
    - [Función `getJugadores()`](#función-getJugadores)
    - [Función `getJugador()`](#función-getJugador)
    - [Función `delete()`](#función-delete)
    - [Función `create()`](#función-create)
    - [Función `update()`](#función-update)
    - [Función `getPorClub()`](#función-get)
___

# Documentación `jugadorApiController`

## Función `getJugadores()`

La función `getJugadores` del controlador obtiene todos los jugadores de la base de datos y envia una respuesta con los mismos.

## Ejemplos de uso
### Ejemplo 1: Obtención exitosa de tareas.
### Method: `GET`.
### URL: `tp3/api/getJugadores/`.

A continuacíon se detalla imágen de la URL:

```json
{
    "status": 200,
    "data": [
        {
            "id": "9",
            "nombre": "Juan",
            "apellido": "Per",
            "club": "Delvalle",
            "representante_id": "2"
        },
        ...
    ]
}
```
## Ejemplos de uso Query Params
 A continuación se detallan los posibles parámetros que puede recibir la URL:
- **atribute**; permite filtrar por los siguiente atributos, los valores que puede tomar son los siguientes:
    - id
    - nombre
    - apellido
    - club
    
- **order** Permite ordenar dichos atributos, los valores que puede tomar son los siguientes:
    - ASC
    - DESC

### Ejemplo de URL con parámetros: `?atribute=nombre&order=asc`.

A continuacíon se detalla la URL:

### Ejemplo de URL con parámetros: `tp3/api/getJugadores?atribute=id&order=desc`

### Ejemplo 2: Jugadores no encontrados

Si no existen jugadores en la base de datos, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "No hay jugadores en la base de datos"
   }
}
```

### Ejemplo 3: Error de servidor

Si ocurre un error del servidor, la función enviará una respuesta con código 500 y un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: [detalles del error]"
}
```
___

## Función `getJugador()`

La función `getJugador` lo que hace es que te va a traer un jugador que busques, con todos sus atributos.

### Parámetros
**`$params (array)`: Un array asociativo que contiene los parámetros de la solicitud. En este caso, se espera que contenga '`:ID`', el identificador de la tarea que se desea obtener.**


## Ejemplos de uso
### Ejemplo 1: Obtención exitosa de un Jugador.
### Method: `GET`.
### Params: `{id}`.
### URL: `tp3/api/getJugador/11`.

Si el jugador con el ID proporcionado existe, la función enviará una respuesta con código 200 y la tarea en formato JSON:
```json
{
    "status": 200,
    "data": {
    "id": "11",
    "nombre": "Julian",
    "apellido": "De La Fuente",
    "club": "Gimnasia",
    "representante_id": "2"
}
}
```

### Ejemplo 2: Jugador no encontrado

Si no existe un Jugador con el ID proporcionado, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "El jugador no se encontro"
   }
}
```

### Ejemplo 3: Error de servidor

Si ocurre un error del servidor, la función enviará una respuesta con código 500 y un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: [detalles del error]"
}
```
___

## Función `delete()`


## Ejemplos de uso
### Ejemplo 1: Eliminacion exitosa de una jugador.
### Method: `DELETE`.
### Params: `{id}`.
### URL: `tp3/api/delete/11`.

Si el jugador con el ID proporcionado existe, la función enviará una respuesta con código 200 y la tarea en formato JSON:
```json
{
   {
    "msg": "El jugador se elimino correctamente"
}
}

```

### Ejemplo 2: Jugador no encontrado

Si no existe un Jugador con el ID proporcionado, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "El jugador no se encontro"
   }
}
```
## Función `create()`

## Ejemplos de uso
### Ejemplo 1: Crear un jugador.
### Method: `POST`.
### Params: `{id}`.
### URL: `tp3/api/create`.

Para crear un jugador se debe agregar las cosas, por ejemplo, con postman creas un JSON con los atributos y luego los envias:
```json
{
   {
    "msg": "El jugador fue agregado"
}
}
```
## Función `update()`
## Ejemplos de uso
### Ejemplo 1: Crear un jugador.
### Method: `PUT`.
### Params: `{id}`.
### URL: `tp3/api/update/9`.
Si existe un jugador con esa ID, la funcion te enviara un mensaje que el jugador fue modificado:
```json
{
   {
        "msg": "El jugador se modifico correctamente"
}
}
```
### Ejemplo 2: Jugador no encontrado

Si no existe un Jugador con el ID proporcionado, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "El jugador no se encontro"
   }
}
```
## Función `get()`
## Ejemplos de uso
### Ejemplo 1: buscar un jugador.
### Method: `GET`.
### Params: `{club}`.
### URL: `tp3/api/get/delvalle`.
Si existe jugadores con ese club, te traera un JSON con todos.
```json
{
   {
          {
        "id": "9",
        "nombre": "Juan",
        "apellido": "Per",
        "club": "Delvalle",
        "representante_id": "2"
    }
}
}
```
### Ejemplo 2: Jugador no encontrado

Si no existe un Jugador con el ID proporcionado, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "El club no se encontro"
   }
}
```


___
