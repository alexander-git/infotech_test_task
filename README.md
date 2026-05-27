# Инициализация проекта

1. Выполнить **make init**
2. Добавить значение SMSPILOTRU_API_KEY в в src/protected/.env

либо

1. подготовить файлы .env и src/protected/.env на основе .env.example.
Установить в src/protected/.env значения для переменных
TEST_USER_EMAIL, TEST_USER_PASSWORD, SMSPILOTRU_API_KEY, SMSPILOTRU_EMULATE_REQUEST
2. docker-compose up -d
3. docker exec -t php-fpm  sh -c "cd protected && composer install"
4. docker exec -t php-fpm  sh -c "protected/yiic migrate up --interactive=0"

<p>
При иницализации в базу данных добавляется тестовый пользователь с именем и паролем взятым из переменных 
TEST_USER_EMAIL, TEST_USER_PASSWORD файла ./src/protected/.env. 
По умолчанию email - testuser@example.com, пароль - password.
От имени этого пользоватлеся можно осуществлять CRUD операции с книгами и авторами.
</p>
<p>
Также при инициализации выполнется миграция которая добавляет случайных авторов, книги и связи между ними в базу данных.
</p>

# Основные Маршруты

1. **/** - главная страница. Содержит ссылки на другие страницы.
2. **/site/login**  - залогиниться.
3. **/site/logou**t  - разлогиниться.
3. **/book/index** - список книг.
4. **/author/index** - список авторов.
5. **/report/years** - список отчётов по годам.

Подписка может осуществляется гостем на странице конкретного автора - **/author/1** 