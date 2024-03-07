docker-compose build
docker-compose up -d

phpmyadmin:
login: root / password: pass
http://localhost:3032/


app:
http://localhost:3030/

secured_app:
login: admin / password: admin
http://localhost:3030/list
