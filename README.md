[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

# Testcenter
(Docker-)Setup for the Testcenter Application

**This compose-file is for development/showcase purposes. Not for deployment.**

# run

```
git clone --recurse-submodules https://github.com/iqb-berlin/iqb-tba-docker-setup.git
cd iqb-tba-docker-setup
docker-compose up
```

*Hint*: If you get timeouts while building fresh images build them separately or increase docker-compose
timeout: `export COMPOSE_HTTP_TIMEOUT=300`.

# Prerequisites
- docker version 19.03.1
- docker-compose version 1.24.1

# ports:services

- 4201: testcenter
- 9090: php backend(s)
- 9091: mysql database
