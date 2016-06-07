# PHP Pircelist Sample App

Create a new project (optional)
```
user@host$  oc new-project test --display-name="Test Project"
```

Create Database using the example below (NOTE: The values of `MYSQL_USER`,`MYSQL_PASSWORD`, and `MYSQL_DATABASE` can be set to whatever you'd like *HOWEVER* `DATABASE_SERVICE_NAME` must be kept as `mysql`)
```
user@host oc new-app --name=mysql -l appname=mysqlcrud --template=mysql-ephemeral -p DATABASE_SERVICE_NAME=mysql,MYSQL_USER=pricelist,MYSQL_PASSWORD=pricelist,MYSQL_DATABASE=pricelist
```

Create your application using the following parameters
```
user@host$ oc new-app --name=pricelist https://github.com/christianh814/php-pricelist
user@host$ oc expose svc/pricelist
```
