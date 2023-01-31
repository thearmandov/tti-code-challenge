# TTI Code Challenge
## Getting Started:

### Requirements
- Verify PHP version (>8.0.1)
- MySQL 5.7+
- Composer

### To run locally:

- clone repo to desired location
- inside app directory using terminal, run: `composer install`
- copy `.env.example` and rename to `.env`
- Replace the following with your local database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tti_local
DB_USERNAME=root
DB_PASSWORD=
```

- inside app directory and using terminal, use the command: `php artisan key:generate`
- to run app locally, in terminal type: `php artisan serve`

*NOTE: Be sure to follow the DB Migration steps below before attempting to access the API.*

### DB Migrations

This app comes with a custom Database seeder that provides the following:
- 30 Users (total)
- 2 Doctors 
- 28 Patients

To seed the database, follow the steps below (using cli artisan commands):

- `php artisan migrate`
- `php db:seed`

Doctors:

```
    Doctor 1:
    email: doctor1@test.com
    password: password
```

```
    Doctor 2:
    email: doctor2@test.com
    password: password
```

Logging in with any patient and trying to access the /patients endpoint will result in an error response: check `Request Examples` below for more information.

### Routes:

- /login -- Basic authentication platform for all users. Assigns a token to user for granting access to /patients.
- /patients -- Provides a json response will appropiate patient data for the assigned doctor.

### Request Examples:

#### /login [POST]

`Request:`
```
{
    "email": "justanotheremail@example.org",
    "password": "supersecurepassword"
}
```

`Response (200):`
```
{
    "auth": {
        "email": "tyshawn10@example.org",
        "status": "PATIENT",
        "access_token": "2|TXrz5qrESzMQuY3l8F9FAzbav9owCBEwaNBqCeaq"
    }
}
```


### /patients [GET]

`Required Header:`
```
    Authorization: Bearer {access_token}
```

`Response (200)`
```
{
    "data": {
        "id": 1,
        "doctor": "Gavin Greenfelder",
        "patients": [
            {
                "patient_id": 1,
                "first_name": "Dakota",
                "last_name": "Sanford",
                "email": "abshire.christina@example.com"
            },
            {
                "patient_id": 2,
                "first_name": "Kailyn",
                "last_name": "Emmerich",
                "email": "iharris@example.org"
            },
            ...
        ]
    }
}
```

If a patient tries accessing this endpoint, they will receive a 403 error. 
Using an invalid token will result in a 401 error.