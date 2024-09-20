# Clean Architecture With Domain Driven Design

- [API](#api)
- [Auth](#auth)
    - [Register](#register)
        - [Register Request](#register-request)
        - [Register Response](#register-response)
    - [Login](#login)
        - [Login Request](#login-request)
        - [Login Response](#login-response)
    - [Logout](#logout)
        - [Login Request](#login-request)
        - [Login Response](#login-response)

## Auth

### Register

```js
POST {{host}}/auth/register
```

#### Register Request

```json
{
    "firstName": "Fist",
    "lastName": "Last",
    "email": "email@domain.com",
    "password": "password"
}
```

#### Register Response

```js
200 Ok
```

```json
{
    "id": "GUID",
    "firstName": "Fist",
    "lastName": "Last",
    "email": "email@domain.com",
    "token": "TOKEN"
}
```

```js
422 Unprocessable Content
```

```json
{
    "message": "The first name field is required. (and 1 more error)",
    "errors": {
        "firstName": [
            "The first name field is required."
        ],
        "lastName": [
            "The last name field is required."
        ]
    }
}
```

### Login

```js
POST {{host}}/auth/login
```

#### Login Request

```json
{
    "email": "email@domain.com",
    "password": "TOKEN"
}
```

#### Login Response

```js
200 Ok
```

```json
{
    "id": "GUID",
    "firstName": "Fist",
    "lastName": "Last",
    "email": "email@domain.com",
    "token": "TOKEN"
}
```

```js
422 Unprocessable Content
```

```json
{
    "message": "The email field is required. (and 1 more error)",
    "errors": {
        "firstName": [
            "The email field is required."
        ],
        "lastName": [
            "The password field is required."
        ]
    }
}
```

### Logout

```js
POST {{host}}/auth/logout
```

#### logout Request

```json
Authorization: Bearer {{token}}
```

#### logout Response

```js
200 Ok
```

```json
{
    "message": "logged out"
}
```
