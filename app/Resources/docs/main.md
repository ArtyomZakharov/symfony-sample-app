# Metadata <span id="meta"></span>

## 1. Page number based pagination

Fields

* meta `object`: Metadata
  * counters `object`: Counters
    * page `int`: Current page number
    * pages `int`: Total pages number
    * items_per_page `int`: Number of items per page
    * current_items `int`: Current items number
    * total_items `int`: Total items number
  * links `object`: Pagination links
    * self `string`: Current page URL
    * first `string`: First page URL
    * last `string`: Last page URL
    * previous `string`: Previous page URL
    * next `string`: Next page URL

Example

```
{
  "meta": {
    "counters": {
      "page": 6,
      "pages": 100,
      "items_per_page": 10,
      "current_items": 10,
      "total_items": 1000
    },
    "links": {
      "self": "/api/v1/artists?page=6",
      "first": "/api/v1/artists?page=1",
      "last": "/api/v1/artists?page=100",
      "previous": "/api/v1/artists?page=5",
      "next": "/api/v1/artists?page=7"
    }
  },
  "items": [
    ...
  ]
}
```
