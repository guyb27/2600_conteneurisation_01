# Use the official Python image as a base
FROM python:3

# Set working directory
WORKDIR /sqlmap

# Install Git to allow cloning the SQLMap repository
RUN apt-get update && apt-get install -y git && rm -rf /var/lib/apt/lists/*

# Clone the SQLMap repository with a shallow copy to reduce image size
RUN git clone --depth 1 https://github.com/sqlmapproject/sqlmap.git .

# Set the default entrypoint to SQLMap
ENTRYPOINT ["python3.12", "sqlmap.py"]

