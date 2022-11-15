The endpoint to the API : http://localhost/WEB2/Tp2-Prueba/api/reviews

Resourse name:
 - reviews

APIs will be generated:

Method          Url             Code 
GET	        /reviews	        200	
GET	        /reviews/:id	    200	
POST	    /reviews	        201
PUT	        /reviews/:id	    200	
DELETE	    /reviews/:id	    200 

GET: localhost/WEB2/Tp2-Prueba/api/reviews
GET: localhost/WEB2/Tp2-Prueba/api/reviews/:id
POST: localhost/WEB2/Tp2-Prueba/api/reviews
{
    "review": "String",
    "name": "String",
    "email": "String",
    "rating": integer,
    "id_album_fk": integer
}
PUT: localhost/WEB2/Tp2-Prueba2/api/reviews/:id
DELETE: localhost/WEB2/Tp2-Prueba/api/reviews/:id

SORTING
Add query params to GET requests:

    /reviews?sort=review&orderBy=asc
    /reviews?sort=review&orderBy=des
    
    /reviews?sort=rating&orderBy=asc
    /reviews?sort=rating&orderBy=desc

    /reviews?sort=album&orderBy=asc
    /reviews?sort=album&orderBy=desc

Note: if you omit order parameter, the default order will be asc.



