<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

Coucou les macaques c'est pas compliqué alors suivez juste les etapes heins bisou.
<h2>Installation du projet</h2>    
- git clone https://github.com/Politrax/BioTouriste.git
- composer install (dans le projet bien evidemment)
- php artisan key:generate
- php artisan migrate:fresh --seed
- Ajouter dans le dossier .env les variables 
    ADMIN_API_TOKEN=(Le token de l'admin que vous avez dans votre base de donnée)
    ADMIN_API_ID=5


<h2>Lancer le projet</h2>
- php artisan serve (Pour le projet laravel)
- php artisan serve --port 8001 (Pour l'api laravel)    


<h4>Bon si jsuis pas trop con normalement j'ai rien oublié et sa dois marché de votre coté</h4>