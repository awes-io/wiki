FROM nginx:1.15.3-alpine

WORKDIR /app

COPY . .

EXPOSE 8080
