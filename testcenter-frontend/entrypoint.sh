#!/usr/bin/env bash

# add config
cp /app/src/environments/environment.build.ts /app/src/environments/environment.ts
sed -i -E "s/testcenterUrl:\s?['\"](.*?)['\"]/testcenterUrl:'http:\/\/localhost:9090\/'/" /app/src/environments/environment.ts
more /app/src/environments/environment.ts

# compile & start app & keep container open
ng serve --host 0.0.0.0
