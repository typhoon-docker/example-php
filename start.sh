#!/bin/bash

docker run --name lolphp -p 8866:80 -e VIRTUAL_HOST=php.local.me --rm example-php
