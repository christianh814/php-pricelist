# Pricelist Operator

You can now deploy Pricelist as an operator on OpenShift (Work is being done to "simplify" it so you can use it on "bare" Kubernetes too)

## Installation

Everything you need to install is in this repo; so go ahead and clone it

```
$ git clone https://github.com/christianh814/php-pricelist
$ cd php-pricelist/openshift/operator/pricelist-operator/
```

In order to install this Operator you need user a user that has a cluster role of `cluster-admin` (in this example I'm using `system:admin`), since we'll be installing a role, a rolebinding, and a CRD

```
$ oc login -u system:admin
```

The Pricelist operator needs to be installed in a namespaces called `pricelist-operator`

```
$ oc new-project pricelist-operator
$ oc project pricelist-operator
```

Fist, deploy the service account and the role/rolebindings needed

```
$ oc create -f deploy/service_account.yaml
$ oc create -f deploy/role.yaml
$ oc create -f deploy/role_binding.yaml
```

Next, create the CRD definition

```
$ oc create -f deploy/crds/pricelist_v1alpha1_pricelist_crd.yaml
```

Lastley, deploy the operator itself

```
$ oc create -f deploy/operator.yaml
```

After a little bit the operator should be up and running

```
$ oc get pods
NAME                                  READY     STATUS    RESTARTS   AGE
pricelist-operator-5bd6f66485-998mt   2/2       Running   0          24s
```

This Operator is ready for action! Proceed to the [usage](#usage) section to deploy an instance of Pricelist

## Usage

Any OpenShift user can down deploy Pricelist. First login to your OpenShift cluster

```
$ oc login -u developer
```

If you don't have a project create one (you can use any project you have access to as well)

```
$ oc new-project foobar
$ oc project foobar
```

Create the CR file. The only one required is how many frontends you'd like to deploy. Create a file called `pricelist.yaml` with the following content (Please see [Advanced Features](#advanced-features) for more CR options)

```yaml
apiVersion: pricelist.chernand.io/v1alpha1
kind: Pricelist
metadata:
  name: myexample
spec:
  frontends: 1
```

After you have this file, create it in your namespace/project

```
$ oc create -f pricelist.yaml
```

When the operator has finished deploying the app; you should have the following pods

```
$ oc get pods
NAME                                            READY     STATUS      RESTARTS   AGE
myexample-pricelist-db-6dcc8cb545-l9xjl         1/1       Running     0          2m
myexample-pricelist-frontend-5d74856d9f-6hr8q   1/1       Running     0          2m
myexample-pricelist-postdeploy-ztwxx            0/1       Completed   0          2m
```

You can list your deployments with the `oc get ...` command

```
$ oc get pricelists
```

Pricelist is now ready to use! 

```
$ firefox $(oc get route --no-headers | grep pricelist-frontend | awk '{print $2}')
```

## Advanced Features

Here are some advanced features to customize the deployment of Pricelist (more will be added soon!)

__Database Configuration__

By default the database name, the database user, and database password, are set to `pricelist`. To change this; you can set `database`, `dbuser`, and `dbpassword` in your CR configuration


```yaml
apiVersion: pricelist.chernand.io/v1alpha1
kind: Pricelist
metadata:
  name: myexample
spec:
  frontends: 1
  database: "pricelist"
  dbuser: "pricelist"
  dbpassword: "pricelist"
```

__Database Storage__

By default, the database uses `emptyDir` for storage; making the DB ephemeral. To have the operator deploy the DB with persistant storage, set the `dbstorage` variable to `yes`. (**NOTE** This assumes you have [Dynamic Volume Provisioning](https://kubernetes.io/docs/concepts/storage/dynamic-provisioning/) setup!)

```yaml
apiVersion: pricelist.chernand.io/v1alpha1
kind: Pricelist
metadata:
  name: myexample
spec:
  frontends: 1
  database: "pricelist"
  dbuser: "pricelist"
  dbpassword: "pricelist"
  dbstorage: yes
```

__Database With StorageClass__

If you do not want to use the default storageclass; you can set `dbstorageclass` to the name of the storageclass you'd like to use. (**NOTE**: You __**MUST**__ set `dbstorage` to `yes` as well!!)

```yaml
apiVersion: pricelist.chernand.io/v1alpha1
kind: Pricelist
metadata:
  name: myexample
spec:
  frontends: 1
  dbstorageclass: "glusterfs-storage-block"
  dbstorage: yes
```

__Scale Frontends__

You cannot scale this app by "normal" means (since it's being managed by the operator). So in order to scale the frontend web app; just change the `frontends` in your CR definition. Fastest way is...

```
$ cat <<EOF | oc replace -f -
apiVersion: pricelist.chernand.io/v1alpha1
kind: Pricelist
metadata:
  name: myexample
spec:
  frontends: 2
EOF
```

You can also just edit the CR as you would any normal resource

```
$ oc edit pricelist myexample
```

After a little bit you will see the application scale!
