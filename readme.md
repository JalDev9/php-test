## Ensure you have the following installed on your local machine:

- PHP 8.x
- MySQL 5.x
- Composer

## Setup

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/JalDev9/php-test.git
   cd php-test

2. **Environment Configuration**
    ```bash
    cp .env.example .env

2. **Import Subscriber table schema**

    Go to DB folder and import **subscribers.sql** to your database.

3. **Install Dependencies**
    ```bash
    composer install

4. **Start the PHP Server**
    ```bash
    php -S localhost:8000

5. **Access the Application**

    Open your web browser and navigate to http://localhost:8000 to access the local instance of your PHP application.
    


# API Interaction with Postman

## Create a Subscriber

**Endpoint:** `POST http://localhost:8000`

**Request:**
1. Open Postman and create a new POST request.
2. Set the request URL to `http://localhost:8000`.
3. Set the request method to POST.  
4. Add the following JSON payload to the request body:
   ```json
   {
     "email": "test@example.com",
     "name": "John",
     "lastName": "Doe",
     "status": "active"
   }

## Get All Subscribers

**Endpoint:** `GET http://localhost:8000`

**Request:**
1. Open Postman and create a new GET request.
2. Set the request URL to `http://localhost:8000`.
3. Set the request method to GET.

# PHP API Scaling Guide

## Load Balancing

Implement load balancing to distribute incoming requests across multiple server instances. This prevents a single server from becoming a bottleneck.

### Example:
- Use NGINX or HAProxy for on-premises setups.
- Leverage cloud-based load balancers like those offered by AWS, GCP, or Azure.

## Horizontal Scaling

Deploy multiple instances of your API across different servers or containers to handle increased load.

### Example:
- Use container orchestration tools like Kubernetes or Docker Swarm to manage and scale API containers.

## Caching

Implement caching mechanisms to reduce the load on your database and improve response times for frequently requested data.

### Example:
- Utilize Redis or Memcached for storing frequently accessed data.

## Database Optimization

Optimize database queries and indexes to ensure efficient data retrieval.

### Example:
- Use read replicas to distribute the database read load.

## Connection Pooling

Use connection pooling to efficiently manage database connections and reduce the overhead of creating new connections for each request.

### Example:
- Configure MySQL or PostgreSQL with connection pooling.

## Rate Limiting

Implement rate limiting to prevent abuse or excessive requests from a single client.

### Example:
- Use token bucket algorithms or a dedicated API gateway with rate-limiting features.

## Distributed Databases

Consider using distributed databases that can scale horizontally.

### Example:
- Use Apache Cassandra, Amazon DynamoDB, or Google Cloud Bigtable for large data volumes.

## Asynchronous Processing

Offload time-consuming tasks to background processes or queues.

### Example:
- Implement a message queue system (e.g., RabbitMQ, Apache Kafka) to process tasks asynchronously.

## Monitoring and Scaling Policies

Implement monitoring tools and set up scaling policies to adjust the number of instances based on predefined metrics.

### Example:
- Use tools like Prometheus, Grafana, and auto-scaling features in cloud environments.

## Auto-Scaling in Cloud Environments

Leverage auto-scaling features in cloud environments to dynamically adjust the number of instances based on demand.

### Example:
- Use AWS Auto Scaling, Google Cloud AutoML, or Azure Autoscale.
