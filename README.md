após clonar você precisará entrar no diretório (como falamos recomendamos o wsl2, você precisará utilizar o linux ok, para isso irei falar os comandos para o ambiente linux) 

então de os seguinte comandos 

```jsx
cd kora-helper
```

após isso você estará na página do projeto vamos começar a configurar o ambiente, primeiro precisamos copiar o arquivo .env.example que é o arquivo de configuação do laravel para isso digite 

```jsx
cp .env.example .env
```

agora vamos preparar nossas variáveis de ambiente, vamos começar configurando o banco de dados

se você ler nosso arquivo docker-compose.yml

ele está da seguinte forma 

```jsx
    db:
        image: mysql:5.7.22
        restart: unless-stopped
        environment:
            MYSQL_DATABASE: ${DB_DATABASE:-laravel}
            MYSQL_ROOT_PASSWORD: ${DB_PASSWORD:-root}
            MYSQL_PASSWORD: ${DB_PASSWORD:-userpass}
            MYSQL_USER: ${DB_USERNAME:-username}
        volumes:
            - ./.docker/mysql/dbdata:/var/lib/mysql
        ports:
            - "3388:3306"
        networks:
            - laravel
```

perceba nosso container do banco de dados tem o nome de db e ele utiliza a porta 3388 isso será importante mais a frente. 

visto isso vamos configurar nosso .env

para isso você pode entrar direto pelo visual studio code 

```jsx
code .
```

após isso localize o .env e edite-o

```jsx
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel (nome do banco de dados que você quer)
DB_USERNAME=root    (nome do usuário para acessar o banco)
DB_PASSWORD=root    (senha)
```

e por ultimo motifique essa linha:

```jsx
FILESYSTEM_DISK=local AQUI MUDE LOCAL PARA public

ficando assim 
FILESYSTEM_DISK=public
```

e por fim só subir os container, para isso digite

```jsx
docker-compose up
```

feito isso os containers começarão a subir aguarde tudo ser finalizado após isso agora em um novo terminal dentro da pasta podemos digitar o seguinte:

```jsx
docker-compose exec app bash
```

com isso estaremos entrando dentro do container docker em questão e lá precisamos dar alguns comandos.

```jsx
composer install 
```

após instalar tudo vamos digitar um ultimo comando

```jsx
php artisan key:generate
```

seu ambiente estará pronto, só que não terá nada no banco de dados, 

vamos agora criar o database, EU particularmente gosto de utilizar o dbeaver
basta configurar 
![Untitled](https://prod-files-secure.s3.us-west-2.amazonaws.com/674ff42e-0a05-4f99-a87b-034b98414dd5/51ba69c4-8f51-43bb-82f6-be238c6620bf/Untitled.png)
no server Host coloque [localhost](http://localhost) 
na porta lembra que falei sobre a porta 3388 que colocamos no docker-compose.yml?  basta você colocar aqui a mesma porta que estiver no docker-compose.yml

nome do usuário: coloque o nome do usuário

nome da senha:  coloque a senha informada

se você quiser criar seu usuário e sua senha procure as seguintes pastas 

database\seeders\UserTableSeeder.php

lá você poderá mudar o nome de usuário, email, e senha.

feito isso ainda dentro do container docker você pode digitar o seguinte comando 

```jsx
php artisan migrate:fresh --seed
```

com isso alguns dados serão inseridos como o usuário que você escolheu

por fim tudo estará pronto então acesse a seguinte url 

```jsx
http://localhost:8989
```

para acessar o painel administrativo acesse
```jsx
http://localhost:8989/admin
```
