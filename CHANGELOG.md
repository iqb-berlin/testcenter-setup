#Changelog

## Frontend 12.1.5
* Fix Navigation Bug from 12.1.3: When a testlet had a locking code, but was unlocked, the unit didn't get tested
  for force_presentation_complete/force_response_complete when leaving.

## Frontend 12.1.4
skipped

## Frontend 12.1.3
* Various Bugfixes:
* (#361) clock and messages in demo-mode are broken
* (#373, #359, #376, #358, #374) could not leave unit behind codeword when navigationRestrictions
* (#379, #372) testee was required to enter codeword even when forced into block by monitor

## Frontend 12.1.2
* Fix Login on Safari

## Frontend 12.1.1
* Fix critical bug in debouncing responses between frontend and backend which led to dataloss in case of very fast
  navigation between units

## Frontend 12.1.0
* There are different login-button for admin-users and for testees now.

## Backend 12.2.2
* massive performance improvement by caching file information in the DB.


## 11.5.1@8.1.0+2.0.3

* Includes the new Sys-Settings module to allow a wide range of customizations of the app!
* A bunch of Bug-Fixes in Session-Management and File-Management


## 10.0.0@7.0.0+2.0.3

Contains a refactored init-script to update the database structure 
of an existing installation automatically when the system gets updated. 

