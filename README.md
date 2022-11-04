# Trabajo Práctico SDS - XSS
<hr>

El presente trabajo practico tiene como objetivo explicar como funciona en la practica la vulnerabilidad Cross-site Scripting, tambien conocida como XSS.
Se presenta el caso de un foro donde distintos usuarios pueden realizar comentarios acerca del cursado en la materia Seguridad en el Desarrollo de Software en el año electivo 2022.
Cada usuario posee un usuario y contraseña para poder ingresar al sistema.

## Vulnerabilidad 

En este caso particular se expondra <b>XSS Persitente o Directo</b> considerado el tipo mas risgoso y el que mas daño causa. En este tipo de ataque, el código o script malicioso se almacena en la base de datos y se ejecuta cada vez que los usuarios llaman a la funcionalidad adecuada. De esta forma, los ataques XSS almacenados pueden afectar a muchos usuarios.
Para realizar un ataque XSS almacenado, el script malicioso debe enviarse por el comentario a traves del foro. De esta manera, el script se guardará en la base de datos y se ejecutará en la carga de la página.

## Posibles defensas

En esta oportunidad se implementara una de las soluciones para hacer frente a esta vulnerabilidad: Encoding de etiquetas


## Tecnologias
### Lenguajes
<ol>
    <li>PHP</li>
    <li>CSS</li>
    <li>Dockerfile</li>
</ol>

### Base de Datos
<ol>
    <li>MySQL</li>
</ol>

Vector de ataque: 
Me encanto la materia. El curso K3 super recomendable.
<p>
 &lt;script&gt;
        document.querySelector("#ataque").innerHTML= "&lt;h1&gt;Puntos extra para SDS!!&lt;/h1&gt;&lt;p&gt;Ingresa al siguiente sitio para obtener puntos extra en la materia: &lt;a href=' '&gt;pagina maliciosa&lt;/a&gt;&lt;/p&gt;            
        &lt;/script&gt;
</p>
