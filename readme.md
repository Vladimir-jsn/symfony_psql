### Symfony 4 DDD Approach

Order application with Symfony 4 and DDD Approach.

#### Folder Structure

```
├── bin
├── config
│   ├── packages
│   │   ├── dev
│   │   ├── prod
│   │   └── test
│   └── routes
│       └── dev
├── public
├── src
│   ├── DataFixtures
│   └── Project
│       ├── App
│       │   ├── EventListener
│       │   ├── Interface
│       │   ├── Support
│       │   └── Trait
│       ├── Console
│       ├── Domain
│       │   ├── Order
│       │       └── Entity
│       ├── Http
│       │   └── Controller
│       ├── Infrastructure
│       │   └── Order
│       └── Resources
│            ├── config
│            ├── doctrine
│            │   └── mapping
│            └── routing
├── templates
├── tests
│   ├── functional
│   ├── integration
│   └── unit
├── translations
└── var
    ├── cache
    └── log
```

### Start With Docker

```bash
# Start the application
docker-compose up -d

# View logs to monitor installation progress
docker-compose logs -f

# Stop the application
docker-compose down

```

This package was built around [JSON API](http://jsonapi.org/) to take advantage of its features around efficiently caching responses, sometimes eliminating network requests entirely.

#### Packages

- Symfony Flex
- Doctrine ORM Bundle
- Doctrine Fixtures
- Twig Bundle
- Nelmio Doc Bundle
- Symfony Profiler (dev)
- Framework Extra Bundle
- Fractal (PhpLeague)
- PagerFanta for Doctrine
