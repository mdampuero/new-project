#!/bin/bash
docker-compose -f docker/docker-compose.yaml up -d
echo "################################################"
echo "##          Installing dependencies           ##"
echo "################################################"
docker exec -ti app-php composer install
echo "################################################"
echo "##                Crear database              ##"
echo "################################################"
sudo mkdir -p site/storage
docker exec -it app-php php bin/console doctrine:database:create
docker exec -it app-php php bin/console doctrine:schema:update --force
echo "################################################"
echo "##                Clear cache                 ##"
echo "################################################"
docker exec -ti app-php php bin/console cache:clear --env prod
echo "################################################"
echo "##     Running on http://localhost:8001/      ##"
echo "################################################"
sudo chmod -R 777 site/var/
sudo chmod -R 777 site/storage/
sudo chmod -R 777 site/web/
sudo chmod 777 site/storage/sqlite.db
