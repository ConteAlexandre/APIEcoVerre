# APIBenzai
The project is API REST for a application web about the glass skips in France. The user is geolocation
with his agreement and after the glass skips in his ray are display on the part [WordPress](https://github.com/NicolasDufresne/WordPressBenzai).

## Contributors
* [Baptiste ANGOT](https://github.com/BaptisteAngot)
* [Nicolas DUFRESNE](https://github.com/NicolasDufresne)
* [Mathias DANTZ](https://github.com/mathD92)
* [Léo FOUQUIER](https://github.com/novaedra)
* [Alexandre CONTE](https://github.com/novaedra)

## Package for operation project
* PHP 7.3
* Composer
* Framework Symfony
* PostGis

## Packages Symfony for the project
* For the communication with database : Doctrine V3.3
* For maker controller and other class : Maker
* For uuid : [Ramsey/uuid](https://github.com/ramsey/uuid)

## Installation project
```
- git clone git@github.com:ConteAlexandre/APIBenzai.git
- cd APIBenzai
- composer install
```

## Installation database
* Created the file .env at the root project
* Copy the content of the file .env.example, then replace in DATABASE_URL the username and password
with your id of postgres
* Then follow the commands line :
```
- php bin/console doctrine:database:create
- Then, go to the database and install the extension [PostGis](https://postgis.net/install/).
- For do it, click right on the extension, create extension and select postgis.
- php bin/console make:migration
- php bin/console doctrine:migration:migrate
```
* Now, you have a database operational

## Start API
After this commands, the project is ready but for start the application, the last command is
```
- php -S localhost:8000 -t public
```

## Conclusion
If you have questions, do not hesitate.