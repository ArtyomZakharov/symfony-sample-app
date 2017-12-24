# Genres

## 1. List

```
GET /api/v1/genres
```

### Response

Possible codes

 Code   | Description
--------|-------------
 200 OK | Array of genres

Fields
* meta `object`: [Metadata](./main.md#meta)
* items `array`: Array of Genre objects
  * id `int`: Genre ID
  * title `string`: Genre title

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
      "title": "Jazz"
    },
    ...
  ]
]
```

## 2. Single

```
GET /api/v1/genres/{id}
```

### Response

Possible codes

 Code             | Description
------------------|-------------
 200 OK           | Genre object
 404 Not Found    | Genre not found

Fields

* id `int`: Genre ID
* name `string`: Genre name
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
  "name": "Jazz",
  "songs": [
    "id": 987,
    "title": "Hit the Road, Jack"
  ]
}
```

## 3. Create

```
POST /api/v1/genres
```

### Request

Parameters

 Name  | Type   | Required? | Description
-------|--------|-----------|-------------
 title | string | true      | Genre title

### Response

Possible codes

 Code             | Description
------------------|-------------
 201 Created      | Genre created
 400 Bad Request  | Validation errors


## 4. Update

```
PATCH: /api/v1/genres/{id}
```

### Request

Parameters

 Name | Type   | Required? | Description
------|--------|-----------|-------------
 name | string | false     | Genre name

### Response

Possible codes

 Code             | Description
------------------|-------------
 200 OK           | Genre updated
 400 Bad Request  | Validation errors
 404 Not Found    | Genre not found

## 5. Delete

```
DELETE: /api/v1/genres/{id}
```

### Response

Possible codes

 Code             | Description
------------------|-------------
 204 No Content   | Genre deleted
 404 Not Found    | Genre not found
