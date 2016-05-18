# HuyHVQ API for Upload file

## How to run

Please add virtual host huyhvq.app match with IP in vagrant file.

## How to test

- Upload file endpoint: http://huyhvq.app/api
make POST request with body content as file binary.
- Retrieve file endpoint: http://huyhvq.app/api/{filename} method GET
- Delete file endpoint: http://huyhvq.app/api/{filename} method DELETE