# Lunaris PHP Framework

Lunaris is a lightweight, expressive PHP framework inspired by [Laravel](https://laravel.com/) - but with a core architectural difference: **modularity**.

Where Laravel follows a centralized structure, Lunaris encourages a module-based approach, allowing each module to maintain its own routes, controllers, views and configurations cleanly seperated and self-contained.

The framework is designed with one core principle in mind, **Full control to the developer**. There's no hidden magic or rigid conventions, just a powerful foundation that adapts to your needs, not the other way around. Lunaris gives you the flexibility to build applications your way without fighting the framework.

### What Makes Lunaris Different?

- **Modular by Default** : Structure your project into isolated modules, making it scalable and easy to maintain.
- **No Central Bloat** : Forget about bloated centralized directories,  every module stands on its own.
- **Developer Centric** : Configure everything. Override anything. You are in full control.

---
## Getting Started

This guide will help you set up a new Lunaris project quickly and understand its modular structure.

### Requirements

##### Local Development :
If you prefer running the project directly on your machine, you'll need:
- PHP >= 8.0
- Composer
- MySQL or compatible database (optional, depending on your usage)

##### Containerized Development :
Alternatively, you can run Lunaris using `Podman` or `Docker`.

### Installation

There are different ways to install Lunaris project.

#### 1. Using composer :

You can initiate Lunaris project from composer by using the command below :

```bash
composer create-project devyuha/lunaris --prefer-dist <your-project-name>
```

#### 2. Clone from Repository :

You can clone the repo using `git bash` and setup.

```bash
git clone https://github.com/Devyuha/lunaris.git
```

```bash
composer install
```

### Project Structure :

```
Lunaris/
├── bootstrap/       # Framework bootstrap logic
├── config/          # Global configuration files
├── core/            # Core framework logic. (You can modify it however you want, but be careful)
├── docker/          # Docker and Podman related files (Dockerfile, docker-compose.yml)
├── modules/         # All self-contained application modules live here
├── public/          # Publicly accessible folder (index.php, assets, etc.)
├── nova/            # CLI and utility scripts (e.g., php nova make:..., key:generate)
└── .env             # Environment variables file

```

---

