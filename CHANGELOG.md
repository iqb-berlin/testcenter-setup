#Changelog

## Backend 12.4.0
### New Feature: so-called resource-packages.
Uploaded zip files with the extension .itcr.zip - resource-packages - now get a special treatment:
1. All files they contain are regarded as resources (Testtakers.xml and such would be handled as resources to).
2. These files do NOT appear in the file list, not do the get validated
3. Deleting the package causes all those files to be deleted.
   This can be used for special resources which shall be loaded by the player via *directDowlaodURL*. But pay attention:
   Those get neither preloaded like the rest of the booklet nor do they count into the size of the calculation of the test!
   Example applications: GeoeGebra (needs to fetch 70+ files), or large videos which shall be streamed.

You can declare now dependencies of Units to some resource-files or -packages in the unit.xml to make the validator
aware of it:
```
  <Dependencies>
    <File>sample_resource_package.itcr.zip</File>
  </Dependencies>
```

### Bugfixes
* (#241) Fix a bug which occurred, when a Booklet was assigned to a Login with mode='monitor-group'.
* (#388) Fix various bugs in the context of the Zip-File Upload.

## Frontend 12.1.7
* (#385) Fix Bug: If testee is on the please-enter-code-screen and group-monitor moves him to the same block,
  it should become unlocked (but didn't).

## Frontend 12.1.6
* (#382) When "Finish Test" gets hit, NavigationRestrictions will be checked.

## Backend 12.3.3
### Bugfixes
* (#239, #238) Fix file reading issues in initialization

## Backend 12.3.0
### Bugfixes
* (#366) Fix: In live-mode the group-monitor didn't update when Testtakers.XMLs get updated or deleted.

### Result-Data / Group-Monitor
* (#231) Logins of the same name (created with `hot-run-restart`-mode) get now a number into there display-name to be
  distinguishable. In result/log-data export, this number is stored in the field `code`.

## Backend 12.2.3
### Bugfixes
* Fix critical bug in communication between broadcasting-service and backend

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

