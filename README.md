# Trabajo Práctico SDS - XSS

## Introduccion
El presente trabajo practico tiene como objetivo explicar como funciona en la practica la vulnerabilidad `Cross-Site Scripting`, tambien conocida como `XSS`.
Se presenta el caso de un foro donde distintos usuarios pueden realizar comentarios acerca del cursado en la materia Seguridad en el Desarrollo de Software en el año 2022.
Cada usuario posee un usuario y contraseña para poder ingresar al sistema.

## Vulnerabilidad 
En este caso particular se expondra **XSS Basado en DOM/Persitente o Directo** considerados los tipos mas riesgosos y que mas daño causas. En este tipo de ataque, el código o script malicioso se almacena en la base de datos y se ejecuta cada vez que los usuarios llaman a la funcionalidad adecuada. De esta forma, los ataques XSS almacenados pueden afectar a muchos usuarios. Los ataques de XSS basado en DOM hace uso del XSS persistente pero luego inyecta en el DOM una seccion de vista maliciosa con la intencion de que el usuario siga alguna instruccion del atacante clickeando en ella.
Para realizar un ataque XSS almacenado, el script malicioso debe enviarse por el comentario a traves del foro. De esta manera, el script se guardará en la base de datos y se ejecutará en la carga de la página, lo mismo para XSS basado en DOM con el cambio de que el comentario debera contener logica para insertar alguna seccion en el DOM.

## Posibles defensas
En esta oportunidad se implementara una de las soluciones para hacer frente a esta vulnerabilidad: `Encoding de etiquetas`.

---
## Tecnologias
### Lenguajes:
- PHP
- CSS
- HTML
### Base de Datos:
- MySQL
### Despliegue:
- Docker
- Docker Compose
### WebServer:
- Nginx

### Vector de ataque:

Vector de ataque: 
```
Me encanto la materia. El curso K3 super recomendable.
<script>
    let titleNode = document.getElementById("title");
    let badDiv = document.createElement("div");
    badDiv.style = "background-color: grey; border-radius: 10px; margin: 15px; text-align: center; vertical-align: middle; width: 300px; margin-top:100px;margin-bottom:100px; font-size:20px;"
    badDiv.innerHTML = "<h2>Puntos extra para SDS! Ingresa al siguiente sitio para obtener puntos extra en la materia: <a href=maliciosa.php>click aqui</a></h2>";
    titleNode.appendChild(badDiv);
</script>
```
