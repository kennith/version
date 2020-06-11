![pest](https://github.com/kennith/version/workflows/pest/badge.svg?branch=master)

# Version

This package is inspired by [`npm version`](https://docs.npmjs.com/cli/version).
 
## Usage

### Publish 

`artisan vendor:publish --provider=Kennith\\Version\\VersionServiceProvider`

### Update a version

Update a patch:

`php artisan version`

Update a specific version:

`php artisan version [major|minor|patch]`
