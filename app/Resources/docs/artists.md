# Artists

## 1. List

```
GET /api/v1/artists
```

### Response

Possible codes

 Code   | Description
--------|-------------
 200 OK | Array of artists

Fields
* meta `object`: [Metadata](./main.md#meta)
* items `array`: Array of Artist objects
  * id `int`: Artist ID
  * name `string`: Artist name

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
      "name": "Ray Charles"
    },
    ...
  ]
]
```

## 2. Single

```
GET /api/v1/artists/{id}
```

### Response

Possible codes

 Code             | Description
------------------|-------------
 200 OK           | Artist object
 404 Not Found    | Artist not found

Fields

* id `int`: Artist ID
* name `string`: Artist name
* songs `array`: Songs list
  * id `int`: Song ID
  * title `title`: Song title

Example

```
Status: 200 OK
```
```
{
  "id": 123,
  "name": "Ray Charles",
  "songs": [
    "id": 987,
    "title": "Hit the Road, Jack"
  ]
}
```

## 3. Create

```
POST /api/v1/artists
```

### Request

Parameters

 Name | Type   | Required? | Description
------|--------|-----------|-------------
 name | string | true      | Artist name

### Response

Possible codes

 Code             | Description
------------------|-------------
 201 Created      | Artist created
 400 Bad Request  | Validation errors


## 4. Update

```
PATCH: /api/v1/artists/{id}
```

### Request

Parameters

 Name | Type   | Required? | Description
------|--------|-----------|-------------
 name | string | false     | Artist name

### Response

Possible codes

 Code             | Description
------------------|-------------
 200 OK           | Artist updated
 400 Bad Request  | Validation errors
 404 Not Found    | Artist not found

## 5. Delete

```
DELETE: /api/v1/artists/{id}
```

### Response

Possible codes

 Code             | Description
------------------|-------------
 204 No Content   | Artist deleted
 404 Not Found    | Artist not found
