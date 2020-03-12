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
