# React + Vite

This template provides a minimal setup to get React working in Vite with HMR and some ESLint rules.

Currently, two official plugins are available:

- [@vitejs/plugin-react](https://github.com/vitejs/vite-plugin-react/blob/main/packages/plugin-react) uses [Babel](https://babeljs.io/) for Fast Refresh
- [@vitejs/plugin-react-swc](https://github.com/vitejs/vite-plugin-react/blob/main/packages/plugin-react-swc) uses [SWC](https://swc.rs/) for Fast Refresh

## Expanding the ESLint configuration

If you are developing a production application, we recommend using TypeScript with type-aware lint rules enabled. Check out the [TS template](https://github.com/vitejs/vite/tree/main/packages/create-vite/template-react-ts) for information on how to integrate TypeScript and [`typescript-eslint`](https://typescript-eslint.io) in your project.

# AppBudget

**AppBudget** est une application de gestion de budget personnelle composée :
- d'une API backend en **Laravel** (avec Laravel Sanctum pour l'authentification),
- d'un frontend mobile/web en **React** avec **Vite**.

---

## 📁 Architecture

```
app-budget/
├── api/           → Laravel 11 (backend REST API)
└── frontend/      → React 18 + Vite (frontend PWA/mobile)
```

---

## 🚀 Installation

### 🔧 Backend (Laravel API)

#### 1. Cloner le projet

```bash
git clone https://github.com/ton-projet/app-budget.git
cd app-budget/api
```

#### 2. Installer les dépendances PHP

```bash
composer install
```

#### 3. Copier le fichier d'environnement

```bash
cp .env.example .env
```

#### 4. Générer la clé d'application

```bash
php artisan key:generate
```

#### 5. Configurer votre base de données dans `.env`, puis exécuter les migrations :

```bash
php artisan migrate
```

#### 6. Installer Laravel Sanctum

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

#### 7. Lancer le serveur API

```bash
php artisan serve
```

L'API est accessible par défaut sur `http://127.0.0.1:8000`.

---

### 🧩 Frontend (React + Vite)

#### 1. Accéder au dossier

```bash
cd ../frontend
```

#### 2. Installer les dépendances

```bash
npm install
```

#### 3. Lancer l'application en développement

```bash
npm run dev
```

Accès : `http://localhost:5173`

---

## 🔐 Authentification

L'authentification repose sur **Laravel Sanctum** :

- L’utilisateur obtient un **token Bearer** via `/api/login` ou `/api/register`.
- Les routes protégées doivent utiliser le middleware `auth:sanctum`.
- Le token doit être envoyé dans les requêtes API :

```http
Authorization: Bearer <votre_token>
```

---

## 📬 Routes API

Quelques routes principales :
- `POST /api/register`
- `POST /api/login`
- `POST /api/logout`
- `GET /api/me`
- `GET /api/accounts`
- `POST /api/accounts`
- `GET /api/operations`
- `POST /api/operations`

---

## ✅ À faire

- [ ] Intégration du frontend avec l'API
- [ ] Déploiement (Docker, Vercel, etc.)
- [ ] Ajout de tests

---

## 🛠️ Tech Stack

- **Laravel 11** (API REST)
- **Laravel Sanctum** (auth)
- **MySQL** / **SQLite**
- **React 18** + **Vite**
- **Tailwind CSS** (optionnel)

---

## 📄 Licence

Ce projet est open source.