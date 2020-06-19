# PHP Pricelist Sample App

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
user@host$ oc new-app --name=mysql -l appname=mysqlcrud --template=mysql-ephemeral \ 
-p DATABASE_SERVICE_NAME=mysql -p MYSQL_USER=pricelist -p MYSQL_PASSWORD=pricelist -p MYSQL_DATABASE=pricelist
```

## Create your application

Create your application using this repo; passing the parameters you used above
```
user@host$ oc new-app --name=pricelist https://github.com/christianh814/php-pricelist -e MYSQL_USER=pricelist -e MYSQL_PASSWORD=pricelist -e MYSQL_DATABASE=pricelist -l appname=pricelist
user@host$ oc expose svc/pricelist
```

If you created the app before the DB you may have to inject these variables
```
user@host$ oc env dc/pricelist MYSQL_USER=pricelist MYSQL_PASSWORD=pricelist MYSQL_DATABASE=pricelist
```
## Initialize the database 

Initialize the DB with a curl cummand

```
curl -k http://$(oc get route/php-pricelist -o jsonpath='{.spec.host}')/create_database.php
```

Where `route/php-pricelist` is what you named the app.

## Operator

If you're just interested in running this app without building it, you may want to take a look at [the operator](openshift/operator)
