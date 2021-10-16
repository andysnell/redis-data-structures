# More Than Just a Cache: Redis Data Structures

Redis is a popular key-value store, commonly used as a cache or message broker
service. However, it can do so much more than just hold string values in memory!
-- Redis is a full-featured “data structure server”. As PHP developers, we
typically don’t think about data structures other than our jack-of-all-trades
array, but Redis can store hashes, lists, sets, and sorted sets, in addition to
operating on string values. In this talk, we’ll explore these basic data
structures in Redis and look at how we can apply them to solve problems like
rate limiting, creating distributed locks, or efficiently checking membership in
a massive set of data.

## Latest Slides
[![More Than Just a Cache: Redis Data Structures](assets/slide-deck.png)](https://wkdb.yt/redis-slides)
**Slide Deck Link:** [https://wkdb.yt/redis-slides](https://wkdb.yt/redis-slides)

## Running Code Examples

Install the appropriate version of [Docker](https://docs.docker.com/get-docker/)
and [Docker Compose](https://docs.docker.com/compose/install/) for your working
environment.

### Starting the Docker Compose Application

`docker-compose up -d`

### Accessing RedisInsight

1. Navigate to localhost:8001
2. Review and agree to the license terms
3. Add a new Redis Database with hostname `redis`, port `6379`, and your choice of name.

![Adding a New Database to RedisInsight](assets/adding-redis-database-to-redisinsight.png)

### Stopping the Docker Compose Application

`docker-compose down`

## Resources

* [Redis](https://redis.io/)
* [Official Docker Image for Redis Server](https://hub.docker.com/_/redis)
* [RedisInsight Documentation](https://developer.redis.com/explore/redisinsight/)
* [Redis Documentation: An introduction to Redis data types and abstractions](https://redis.io/topics/data-types-intro)
* [Redis Server Source Code](https://github.com/redis/redis)
* [PhpRedis Extension](https://github.com/phpredis/phpredis)