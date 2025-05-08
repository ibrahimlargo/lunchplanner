### Short Information about web.php and api.php

If you want to write a normal route that doesn't write in the session driver you have to write the route in the api.php file because you can use the resourceclasses there and so on.
If you want to write a route which uses something of the previous mentioned features you have to write the route in the web.php file because of the web middleware stack (or you add the stack to the route in the api.php.)
Because of that the login routes are in web.php and the other routes are in the api.php file
