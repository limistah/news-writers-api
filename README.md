### GetDev Project

> This project was created with Laravel.

### Setup

To setup this project locally, clone this repo, then create a `.env` file that includes the below config.

```
APP_NAME=GetDev
APP_ENV=local
APP_KEY=base64:xI9N0NFUUIswo5FNuHbQTH95ZG3CmOTXiDtYwv7FYSY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

This project requires a MySQL database is required.

Update the section of the .env file containing the below information with the details of your local MySQL configuration.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

After all the above has been checked, run from the root directory of the project.

```bash
composer install
php artisan key:generate
```

The first command installs the project's PHP dependencies, the second generates application key for the project.

### Authentication

This project uses Laravel's authentication scaffolding, and adds a layer with JWT using the [jwt-auth](https://jwt-auth.readthedocs.io/en/docs/laravel-installation/) package.

To complete the JWT setup, add the following configuration into `.env` file.

```bash
JWT_SECRET=
JWT_PUBLIC_KEY=
JWT_PRIVATE_KEY=
```

Then run the code below:

```bash
php artisan jwt:secret
```

#### Endpoints

##### `POST /register`

Registers a new user into the database. The below fields are expected in the body of the request:

-   **name**: required|string
-   **email**: required|string|email
-   **password**: required|string|min:8
-   **bio**: required|string

**Request**

```bash
curl --location --request POST 'http://getdev.test/api/register' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
	"name": "Aleem Isiaka",
	"email": "aleemisiaka@gmail.com",
	"password": "12345678",
	"bio": "Some information about myself"
}'
```

**Response**

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTU4Mzk3NDM2OSwiZXhwIjoxNTgzOTc3OTY5LCJuYmYiOjE1ODM5NzQzNjksImp0aSI6Ingyc2gySmhVbXI1SzJYUnAiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.rt7PIecfZUXA295d33s1r4BI3bQ1Uxy8sAeJdJ2Qiow",
    "token_type": "bearer",
    "expires_in": 3600
}
```

##### `POST /api/auth/login`

**Request**

```bash
curl --location --request POST 'http://getdev.test/api/auth/login' \
--header 'Content-Type: application/json' \
--data-raw '{
	"email": "aleemisiaka@gmail.com",
	"password": "12345678"
}'
```

**Response**

```json
// Successful response
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4Mzk3NTY0OSwiZXhwIjoxNTgzOTc5MjQ5LCJuYmYiOjE1ODM5NzU2NDksImp0aSI6ImVoN1pjanlPd1BEN3VKWTciLCJzdWIiOjIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.qOSVRHtsHsxaQ_vMmIbwYnIjNLlxsdDWrsbFw4kxmzQ",
    "token_type": "bearer",
    "expires_in": 3600
}

// Unsuccessful response, status code of 401
{
    "error": "Unauthorized"
}
```

##### `POST /api/auth/logout`

**Request**

```bash
curl --location --request POST 'http://getdev.test/api/auth/logout' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4Mzk3NTY0OSwiZXhwIjoxNTgzOTc5MjQ5LCJuYmYiOjE1ODM5NzU2NDksImp0aSI6ImVoN1pjanlPd1BEN3VKWTciLCJzdWIiOjIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.qOSVRHtsHsxaQ_vMmIbwYnIjNLlxsdDWrsbFw4kxmzQ'
```

**Response**

```json
{
    "message": "Successfully logged out"
}
```

##### `POST /api/auth/refresh`

Refreshes JWT token

**Request**

```bash
curl --location --request POST 'http://getdev.test/api/auth/refresh' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4Mzk3NjEzMiwiZXhwIjoxNTgzOTc5NzMyLCJuYmYiOjE1ODM5NzYxMzIsImp0aSI6IkNRMU0ySFN6bkNlR1lUOFgiLCJzdWIiOjIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.v23AzjkAPmKYiqbYsShIfcWm9uZKJ6jZJDaGDr4qGCU'
```

**Response**

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTgzOTc2MTMyLCJleHAiOjE1ODM5Nzk3NTcsIm5iZiI6MTU4Mzk3NjE1NywianRpIjoiQ3hRTUFUUlRyQ0pld01kVSIsInN1YiI6MiwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.bW9rQTDTyj72-5o7Ca-KFRfNZNUTVEhkmSeQ_3n-vr4",
    "token_type": "bearer",
    "expires_in": 3600
}
```

##### `POST /api/password/email`

Sends password reset email to a registered user

Request:

-   **email**: required|string|email - Email of a registered user

```bash
curl --location --request POST 'http://getdev.test/api/password/email' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data-raw '{
	"email": "aleemisiaka@gmail.com"
}'

```

Response

```json
{ "message": "We have emailed your password reset link!" }
```

##### `POST /api/password/email`

Sends password reset email to a registered user

Request:

-   **email**: required|string|email - Email of a registered user

```bash
curl --location --request POST 'http://getdev.test/api/password/email' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data-raw '{
	"email": "aleemisiaka@gmail.com"
}'

```

Response

```json
{ "message": "We have emailed your password reset link!" }
```

##### `POST /api/password/reset`

Resets user's password with the email in the body of the request.

Request:

-   **email**: required|string|email - Email of a registered user
-   **token**: required|string| - Token sent to the provided email after a `POST /api/password/email`
-   **password**: required|string|min:8 - New password
-   **password_confirmation**: required|string|min:8 - Confirms the new password

```bash
curl --location --request POST 'http://getdev.test/api/password/reset' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data-raw '{
	"password": "12345678",
	"password_confirmation": "12345678",
	"token": "2d689c3e71983fd7eef9a508ce885a31e817a7687b2b594552a6f50452767fee",
	"email": "aleemisiaka@gmail.com"
}'
```

Response

```json
{
    "message": "Your password has been reset!"
}
```

### Article Endpoints

##### `POST /api/articles`

Creates a new Article for the authenticated user

Request:

-   **title**: required|string|min:5 - Title of the article
-   **body**: required|string|min:10 - Content of the article

```bash
curl --location --request POST 'http://getdev.test/api/articles' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA0OTQ3NywiZXhwIjoxNTg0MDUzMDc3LCJuYmYiOjE1ODQwNDk0NzcsImp0aSI6Ind2ZWNQOTdJZndCa1lXUW8iLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.TjZBC6dxHnGk-eqThjWrBYwbmtxpvfIdZad84axQT8c' \
--data-raw '{
	"title": "This is the title of the article",
	"body": "Body of the article"
}'
```

Response

```json
{
    "message": "Article saved successfully",
    "data": {
        "title": "This is the title of the article",
        "body": "Body of the article",
        "author_name": "Aleem Isiaka",
        "author_id": 51,
        "updated_at": "2020-03-12T22:17:23.000000Z",
        "created_at": "2020-03-12T22:17:23.000000Z",
        "id": 1502
    }
}
```

#### `GET /api/articles`

Returns all the writers in the application

Request

```bash
curl --location --request GET 'http://getdev.test/api/articles/' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA1NjUwNywiZXhwIjoxNTg0MDYwMTA3LCJuYmYiOjE1ODQwNTY1MDcsImp0aSI6InJ5NjB3ZmdrZ3A3QVBtTGEiLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3_5GTqThscqjIOhZeybiusJRomOcNdlO_aK1M6oh8Jc'
```

Response

```json
{
    "data": [
        {
            "id": 1004,
            "author_name": "Kristian Steuber PhD",
            "author_id": 102,
            "title": "Omnis eos provident nobis necessitatibus nesciunt.",
            "body": "Eum amet quia aspernatur beatae nesciunt.",
            "created_at": "2020-03-12T22:01:37.000000Z",
            "updated_at": "2020-03-12T22:01:37.000000Z",
            "author": {
                "id": 102,
                "name": "Kristian Steuber PhD",
                "email": "reynolds.elva@example.net",
                "email_verified_at": "2020-03-12T22:01:37.000000Z",
                "created_at": "2020-03-12T22:01:37.000000Z",
                "updated_at": "2020-03-12T22:01:37.000000Z",
                "bio": "Nisi voluptatem error maxime qui in aspernatur. Omnis aut consequatur eaque aut aut veniam cupiditate."
            }
        },
        {
            "id": 1006,
            "author_name": "Kristian Steuber PhD",
            "author_id": 102,
            "title": "Sunt assumenda voluptatibus nobis neque laudantium in molestiae.",
            "body": "Exercitationem est ducimus cumque quia aut autem.",
            "created_at": "2020-03-12T22:01:37.000000Z",
            "updated_at": "2020-03-12T22:01:37.000000Z",
            "author": {
                "id": 102,
                "name": "Kristian Steuber PhD",
                "email": "reynolds.elva@example.net",
                "email_verified_at": "2020-03-12T22:01:37.000000Z",
                "created_at": "2020-03-12T22:01:37.000000Z",
                "updated_at": "2020-03-12T22:01:37.000000Z",
                "bio": "Nisi voluptatem error maxime qui in aspernatur. Omnis aut consequatur eaque aut aut veniam cupiditate."
            }
        }
        // ...
    ],
    "links": {
        "first": "http://getdev.test/api/articles?page=1",
        "last": "http://getdev.test/api/articles?page=50",
        "prev": null,
        "next": "http://getdev.test/api/articles?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 50,
        "path": "http://getdev.test/api/articles",
        "per_page": 10,
        "to": 10,
        "total": 497
    }
}
```

#### `GET /api/articles/{article_id}`

Returns a single article with the specified `$id` in the route parameter. Anyone can view a single article

Request

```bash
curl --location --request GET 'http://getdev.test/api/articles/1004' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA1NjUwNywiZXhwIjoxNTg0MDYwMTA3LCJuYmYiOjE1ODQwNTY1MDcsImp0aSI6InJ5NjB3ZmdrZ3A3QVBtTGEiLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3_5GTqThscqjIOhZeybiusJRomOcNdlO_aK1M6oh8Jc'
```

Response

```json
{
    "id": 1004,
    "author_name": "Kristian Steuber PhD",
    "author_id": 102,
    "title": "Omnis eos provident nobis necessitatibus nesciunt.",
    "body": "Eum amet quia aspernatur beatae nesciunt.",
    "created_at": "2020-03-12T22:01:37.000000Z",
    "updated_at": "2020-03-12T22:01:37.000000Z",
    "author": {
        "id": 102,
        "name": "Kristian Steuber PhD",
        "email": "reynolds.elva@example.net",
        "email_verified_at": "2020-03-12T22:01:37.000000Z",
        "created_at": "2020-03-12T22:01:37.000000Z",
        "updated_at": "2020-03-12T22:01:37.000000Z",
        "bio": "Nisi voluptatem error maxime qui in aspernatur. Omnis aut consequatur eaque aut aut veniam cupiditate."
    }
}
```

##### `PUT/PATCH /api/articles/{article_id}`

Updates an article created by the authenticated user. If user is not the owner of the article, an error `"message": "This action is unauthorized."` is returned.

Request:

-   **title**: string|min:5 - Title of the article
-   **body**: string|min:10 - Content of the article

```bash
curl --location --request DELETE 'http://getdev.test/api/articles/1500' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA1NjUwNywiZXhwIjoxNTg0MDYwMTA3LCJuYmYiOjE1ODQwNTY1MDcsImp0aSI6InJ5NjB3ZmdrZ3A3QVBtTGEiLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3_5GTqThscqjIOhZeybiusJRomOcNdlO_aK1M6oh8Jc' \
--data-raw '{
	"body": "Body of the article edited"
}'
```

Response

```json
{
    "message": "Article saved successfully",
    "data": {
        "title": "This is the title of the article",
        "body": "Body of the article",
        "author_name": "Aleem Isiaka",
        "author_id": 51,
        "updated_at": "2020-03-12T22:17:23.000000Z",
        "created_at": "2020-03-12T22:17:23.000000Z",
        "id": 1502
    }
}
```

##### `DELETE /api/articles/{article_id}`

Deletes an article created by the authenticated user. If user is not the owner of the article, an error `"message": "This action is unauthorized."` is returned.

```bash
curl --location --request PATCH 'http://getdev.test/api/articles/1502' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA1NjUwNywiZXhwIjoxNTg0MDYwMTA3LCJuYmYiOjE1ODQwNTY1MDcsImp0aSI6InJ5NjB3ZmdrZ3A3QVBtTGEiLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3_5GTqThscqjIOhZeybiusJRomOcNdlO_aK1M6oh8Jc'
```

Response

```json
{
    "message": "Article deleted successfully",
    "data": {
        "id": 1500,
        "author_name": "Larue Schiller DDS",
        "author_id": 151,
        "title": "Autem doloremque impedit soluta quas dignissimos deleniti odio.",
        "body": "Cum enim porro asperiores facilis officiis. Aut et cupiditate omnis fugit.",
        "created_at": "2020-03-12T22:01:44.000000Z",
        "updated_at": "2020-03-12T22:01:44.000000Z",
        "author": {
            "id": 151,
            "name": "Larue Schiller DDS",
            "email": "torphy.delia@example.com",
            "email_verified_at": "2020-03-12T22:01:37.000000Z",
            "created_at": "2020-03-12T22:01:37.000000Z",
            "updated_at": "2020-03-12T22:01:37.000000Z",
            "bio": "Esse temporibus cupiditate possimus modi."
        }
    }
}
```

---

### Writers Endpoints

#### `GET /api/writers`

Returns all the writers in the application

Request

```bash
curl --location --request GET 'http://getdev.test/api/writers' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA1NjUwNywiZXhwIjoxNTg0MDYwMTA3LCJuYmYiOjE1ODQwNTY1MDcsImp0aSI6InJ5NjB3ZmdrZ3A3QVBtTGEiLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3_5GTqThscqjIOhZeybiusJRomOcNdlO_aK1M6oh8Jc'
```

Response

```json
{
    "data": [
        {
            "id": 1,
            "name": "Avery Moore",
            "email": "ziemann.magdalena@example.net",
            "bio": "Ut eligendi quo earum.",
            "articles_count": 0
        },
        {
            "id": 2,
            "name": "Dr. Clara Emard III",
            "email": "moen.myles@example.com",
            "bio": "Quia ullam cumque et voluptatem velit. Saepe a quasi perferendis vero animi quia.",
            "articles_count": 0
        }
        // ...
    ],
    "links": {
        "first": "http://getdev.test/api/writers?page=1",
        "last": "http://getdev.test/api/writers?page=16",
        "prev": null,
        "next": "http://getdev.test/api/writers?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 16,
        "path": "http://getdev.test/api/writers",
        "per_page": 10,
        "to": 10,
        "total": 151
    }
}
```

#### `GET /api/writers/{writer_id}`

Returns a single writer with the specified `$id` in the route parameter

Request

```bash
curl --location --request GET 'http://getdev.test/api/writers/102' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA1NjUwNywiZXhwIjoxNTg0MDYwMTA3LCJuYmYiOjE1ODQwNTY1MDcsImp0aSI6InJ5NjB3ZmdrZ3A3QVBtTGEiLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3_5GTqThscqjIOhZeybiusJRomOcNdlO_aK1M6oh8Jc'
```

Response

```json
{
    "id": 102,
    "name": "Kristian Steuber PhD",
    "email": "reynolds.elva@example.net",
    "email_verified_at": "2020-03-12T22:01:37.000000Z",
    "created_at": "2020-03-12T22:01:37.000000Z",
    "updated_at": "2020-03-12T22:01:37.000000Z",
    "bio": "Nisi voluptatem error maxime qui in aspernatur. Omnis aut consequatur eaque aut aut veniam cupiditate.",
    "articles_count": 6
}
```

### Writer-Articles Endpoints

#### `GET /api/writers/{writer_id}/articles`

Returns all the articles poster by the writer
Request

```bash
curl --location --request GET 'http://getdev.test/api/writers/151/articles' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nZXRkZXYudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDA1NjUwNywiZXhwIjoxNTg0MDYwMTA3LCJuYmYiOjE1ODQwNTY1MDcsImp0aSI6InJ5NjB3ZmdrZ3A3QVBtTGEiLCJzdWIiOjUxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3_5GTqThscqjIOhZeybiusJRomOcNdlO_aK1M6oh8Jc'
```

Response

```json
{
    "data": [
        {
            "id": 1491,
            "author_name": "Larue Schiller DDS",
            "author_id": 151,
            "title": "Illo ea ipsam omnis accusantium.",
            "body": "Ea impedit ducimus cum sint quia. Et aspernatur ad dolorum vel.",
            "created_at": "2020-03-12T22:01:44.000000Z",
            "updated_at": "2020-03-12T22:01:44.000000Z",
            "author": {
                "id": 151,
                "name": "Larue Schiller DDS",
                "email": "torphy.delia@example.com",
                "email_verified_at": "2020-03-12T22:01:37.000000Z",
                "created_at": "2020-03-12T22:01:37.000000Z",
                "updated_at": "2020-03-12T22:01:37.000000Z",
                "bio": "Esse temporibus cupiditate possimus modi."
            }
        },
        {
            "id": 1492,
            "author_name": "Larue Schiller DDS",
            "author_id": 151,
            "title": "Qui soluta voluptatem suscipit omnis.",
            "body": "Dicta repudiandae quis tempora est. Aut eum fugiat magnam laboriosam ut incidunt.",
            "created_at": "2020-03-12T22:01:44.000000Z",
            "updated_at": "2020-03-12T22:01:44.000000Z",
            "author": {
                "id": 151,
                "name": "Larue Schiller DDS",
                "email": "torphy.delia@example.com",
                "email_verified_at": "2020-03-12T22:01:37.000000Z",
                "created_at": "2020-03-12T22:01:37.000000Z",
                "updated_at": "2020-03-12T22:01:37.000000Z",
                "bio": "Esse temporibus cupiditate possimus modi."
            }
        }
        // ...
    ],
    "links": {
        "first": "http://getdev.test/api/writers/151/articles?page=1",
        "last": "http://getdev.test/api/writers/151/articles?page=2",
        "prev": null,
        "next": "http://getdev.test/api/writers/151/articles?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "path": "http://getdev.test/api/writers/151/articles",
        "per_page": 5,
        "to": 5,
        "total": 9
    }
}
```
