# HuyHVQ API for Upload file

## How to run

At root project folder please run:

```
composer install
```
Then rename *.env.example* to *.env* and run:

```
php artisan key:generate
```

Please make sure folder and subfolder in *storage* has write permission.

## How to play with API

### Upload
{url} is your domain, example my domain is: http://huyhvq.app
- Upload file endpoint: {url}/api
make POST request with body content as file binary and parameter *name* as filename.
Example:

```
curl --request POST --data-binary "@filename" --data="key=value" $URL
```
We can use bellow command for upload:

```
curl -v --request POST --data-binary "@dota.jpg" --data "name=dota2.jpg"  http://huyhvq.app/api
```

### Retrieve
- Retrieve file endpoint: {url}/api/{filename} method GET

```
curl GET $URL
```

My uploaded file is *dota2.jpg*

```
curl -v GET http://huyhvq.app/api/dota2.jpg
```

### Retrieve
- Delete file endpoint: {url}/api/{filename} method DELETE

```
curl -X DELETE $URL
```

My uploaded file is *dota2.jpg*

```
curl -v -X DELETE http://huyhvq.app/api/dota2.jpg
```