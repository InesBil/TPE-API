# Reviews Discography API

The endpoint to the API : http://localhost/WEB2/TPE-API/api/reviews

## ENDPOINTS 

### Servicios GET 

```
GET/reviews
```
_Accedo al listado completo de las reseñas existentes en la base de datos dentro de la tabla 'review'._

* **Ordenamiento por campos**
    ```
   GET/reviews?sort=FIELD&orderBy=ORDERTYPE
    ```
    Utilizando ?sort=FIELD&orderBy=ORDERTYPE se puede ordenar la lista de manera ascendente o descendente por cada campo. Utilizando el sort se puede seleccionar cualquier campo de la tabla. Si no se coloca el orderBy se organizarán por defecto de manera ascendente.

    _**Ejemplo:**_GET/reviews?sort=album&orderBy=desc

* **Paginación**
    ```
    GET/reviews?start=VALUE&limit=VALUE
    ```
    Con los Query Params se selecciona el límite de registros que se muentran por página. 

    _**Ejemplo:**_GET/reviews?start=2&limit=3
    ```
    [
    {
        "id_review": 4,
        "review": "El mejor disco de la historia",
        "name": "Susana",
        "email": "susana@email.com",
        "rating": 5,
        "album": "Whatever People Say I Am, That's What I'm Not"
    },
    {
        "id_review": 6,
        "review": "Me encantaron todas las canciones del disco",
        "name": "Lola",
        "email": "lolita@email.com",
        "rating": 5,
        "album": "AM"
    },
    {
        "id_review": 7,
        "review": "Excelente!!!",
        "name": "Majo",
        "email": "majo@email.com",
        "rating": 4,
        "album": "Who the Fuck Are Arctic Monkeys?"
    }
]
    ```
* GET /review/:ID
    Este endpoint permite acceder a una reseña específica utilizando un id particular.

    _**Ejemplo:**_GET/reviews/11

    ```
    {
        "id_review": 11,
        "review": "Excelente",
        "name": "Susana",
        "email": "susana@email.com",
        "rating": 5,
        "album": "Whatever People Say I Am, That's What I'm Not"
    }
    ```

### Servicio POST

* POST/reviews: Este servicio permite agregar una nueva reseña a la base de datos.

    _**Ejemplo:**_POST/reviews

    
    ```
    {
        "review": "Impresionante",
        "name": "Julia",
        "email": "julia@email.com",
        "rating": 5,
        "id_album_fk": 9
    }
   ```
### Servicio PUT

* PUT/reviews/:ID: Este servicio permite modificar una nueva reseña de la base de datos. Para esto es necesario especificar el registro mediante el id que va por parámetro. Este id debe existir, caso contrario arrojará un estatus 404 Not Found.

    _**Ejemplo:**_PUT/reviews/18

        
    ```
    {
        "review": "Impresionante",
        "name": "Julia",
        "email": "julia@email.com",
        "rating": 5,
        "id_album_fk": 9
    }
   ```
### Servicio DELETE

* DELETE/reviews/:ID: Este servicio elimina un registro de la base de datos. Para esto es necesario especificar el registro mediante el id que va por parámetro. Este id debe existir, caso contrario arrojará un estatus 404 Not Found.

    _**Ejemplo:**_DELETE/reviews/19

    
  


