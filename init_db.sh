#!/bin/bash
docker exec -i $(docker-compose ps -q db)  mysql -u root -proot alitaware < ./data/db.sql
