# PHP Pircelist Sample App

## Create a new project

Create a new project if you don't have one (this step is optional)
```
user@host$  oc new-project test --display-name="Test Project"
```

## Create Database 

Using the example below; create a database app.

NOTE: 
  * The values of `MYSQL_USER`,`MYSQL_PASSWORD`, and `MYSQL_DATABASE` can be set to whatever you'd like
  * However; `DATABASE_SERVICE_NAME` must be kept as `mysql`

```
user@host oc new-app --name=mysql -l appname=mysqlcrud --template=mysql-ephemeral -p DATABASE_SERVICE_NAME=mysql,MYSQL_USER=pricelist,MYSQL_PASSWORD=pricelist,MYSQL_DATABASE=pricelist
```

## Bootstrap the database 

Copy over the `sql` dir from this repo using `oc rsync`
```
user@host$ cd ~
user@host$ git clone https://github.com/christianh814/php-pricelist
user@host$ cd ~/php-pricelist/
user@host$ oc get pods -l appname=mysqlcrud
  NAME            READY     STATUS    RESTARTS   AGE
  mysql-1-9uctm   1/1       Running   0          30s
user@host$ oc rsync ./sql mysql-1-9uctm:/tmp/
  sending incremental file list
  sql/
  sql/createdb.sql

  sent 2669 bytes  received 35 bytes  1081.60 bytes/sec
  total size is 2562  speedup is 0.95 
user@host$ oc rsh mysql-1-9uctm 
  sh-4.2$ mysql -u root pricelist < /tmp/sql/createdb.sql 
  sh-4.2$ exit
```

## Create your application

Create your application using this repo; passing the parameters you used above
```
user@host$ oc new-app --name=pricelist https://github.com/christianh814/php-pricelist -e MYSQL_USER=pricelist -e MYSQL_PASSWORD=pricelist -e MYSQL_DATABASE=pricelist
user@host$ oc expose svc/pricelist
```

If you created the app before the DB you may have to inject these variables
```
user@host$ oc env dc/pricelist MYSQL_USER=pricelist MYSQL_PASSWORD=pricelist MYSQL_DATABASE=pricelist
```
