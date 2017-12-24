# Songs

## 1. List

```
GET /api/v1/songs
```

### Response

Possible codes

 Code   | Description
--------|-------------
 200 OK | Array of songs

Fields
* meta `object`: [Metadata](./main.md#meta)
* items `array`: Array of Artist objects
  * id `int`: Song ID
  * title `string`: Song title
  * artist `object`: Artist
    * id `int`: Artist ID
    * name `string`: Artist name
  * genre `object`: Genre
    * id `int`: Genre ID
    * Title `string`: Genre Title
  * year `int`: Release year

Example

```
Status: 200 OK
```
```
[
  "meta": {
    ...
  },
  "items": [
    {
      "id": 123,
      "title": "Hit the Road, Jack",
      "artist": {
        "id": 123,
        "name": "Ray Charles"
      },
      "genre": {
        "id": 987,
        "title": "Jazz"
      },
      "year": 1961
    },
    ...
  ]
]
```

## 2. Single

```
GET /api/v1/songs/{id}
```

### Response

Possible codes

 Code             | Description
------------------|-------------
 200 OK           | Song object
 404 Not Found    | Song not found

Fields

* id `int`: Song ID
* title `string`: Song title

Example

```
Status: 200 OK
```
```
{
  "id": 123,
  "name": "Hit the Road, Jack"
}
```

## 3. Create

```
POST /api/v1/songs
```

### Request

Parameters

 Name         | Type   | Required? | Description
--------------|--------|-----------|-------------
 title        | string | true      | Song title
 release_date | string | true      | Song release date in ISO8601 format
 artist_id    | int    | true      | Artist ID
 genre_id     | int    | true      | Genre ID

### Response

Possible codes

 Code             | Description
------------------|-------------
 201 Created      | Song created
 400 Bad Request  | Validation errors


## 4. Update

```
PATCH: /api/v1/songs/{id}
```

### Request

Parameters

 Name         | Type   | Required? | Description
--------------|--------|-----------|-------------
 title        | string | false     | Song title
 release_date | string | false     | Song release date in ISO8601 format

### Response

Possible codes

 Code             | Description
------------------|-------------
 200 OK           | Song updated
 400 Bad Request  | Validation errors
 404 Not Found    | Song not found

## 5. Delete

```
DELETE: /api/v1/songs/{id}
```

### Response

Possible codes

 Code             | Description
------------------|-------------
 204 No Content   | Song deleted
 404 Not Found    | Song not found
