## Run Migrations

```
php spark migrate
```

# Membuat private key

```
openssl genpkey -algorithm RSA -out private_key.pem
```

# Membuat public key

```
openssl rsa -pubout -in private_key.pem -out public_key.pem
```
