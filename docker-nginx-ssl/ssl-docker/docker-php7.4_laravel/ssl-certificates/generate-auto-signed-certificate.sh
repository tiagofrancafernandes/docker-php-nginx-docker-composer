DOMAIN=${SSL_CERT_DOMAIN:-localhost}

certificate_crt="./certificates/certificate.crt"
certificate_key="./certificates/certificate.key"

rm "$certificate_crt $certificate_key"

echo -e "Generating certificate to domain ${SSL_CERT_DOMAIN}\nFor another domain, export the var SSL_CERT_DOMAIN\n"
openssl req -x509 -out "$certificate_crt" -keyout "$certificate_key" \
  -newkey rsa:2048 -nodes -sha256 \
  -subj '/CN=$DOMAIN' -extensions EXT -config <( \
  printf "[dn]\nCN=$DOMAIN\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:$DOMAIN\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth")
