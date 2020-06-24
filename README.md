[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

# Testcenter
(Docker-)Setup for the Testcenter Application

**under development**

**This compose-file is for development/showcase purposes. Not for deployment.**

# Getting Started

## Prerequisites
- docker version 19.03.1
- docker-compose version 1.24.1

## Running the application

Get files and build containers:
```
git clone --recurse-submodules https://github.com/iqb-berlin/iqb-tba-docker-setup.git
cd iqb-tba-docker-setup
docker-compose up
```

Open http://localhost:4201 in your browser. You see now the testcenter application with a bunch of testdata inside. 

You can login with:
- Username `super` and password `user132` as admin user
- Username `test` and password `user132` and code `xxx` as test-taker


## Ports

This composition uses the following ports by deafult:

- 4201: testcenter frontend
- 9090: testcenter backend
- 9091: mysql database

Look at ports.md for more.

# Trouble Shooting

## Timeouts when building fresh images
Build them separately or increase docker-compose timeout: `export COMPOSE_HTTP_TIMEOUT=300`.

## Strange SQL Constraint error after re-build
When you rebuild make sure, that you not only delete all previous volumes but delete all contents 
of `testcenter-backend/src/vo_data` as well before. Otherwise, you get an erroneous application state. 
[Will be fixed](https://github.com/iqb-berlin/testcenter-setup/issues/9). 


