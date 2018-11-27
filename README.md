# example-php

## Overview

This project demonstrates how to package and run a simple PHP application using
Docker.

## Build

```
docker build -t example-php .
```

## Running (on port 8022)

```
docker run --name myphp -p 8022:80 --rm example-php
```
