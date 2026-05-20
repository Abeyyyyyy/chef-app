<p align="center">
  <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?q=80&w=400&auto=format&fit=crop" width="120" alt="Chef Atelier Logo" style="border-radius: 50%; box-shadow: 0 4px 20px rgba(0,0,0,0.15); margin-bottom: 20px;">
</p>

<h1 align="center">👨‍🍳 Chef Atelier</h1>

<p align="center">
  <strong>An AI-powered luxury culinary companion & digital pantry manager. Designed for smart kitchens and passionate home chefs.</strong>
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-13.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 13.0"></a>
  <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3"></a>
  <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"></a>
  <a href="https://openrouter.ai"><img src="https://img.shields.io/badge/AI_Engine-Gemini_2.0-orange?style=for-the-badge&logo=google-gemini&logoColor=white" alt="Gemini AI"></a>
  <a href="https://supabase.com"><img src="https://img.shields.io/badge/Database-Supabase-3ECF8E?style=for-the-badge&logo=supabase&logoColor=white" alt="Supabase Backend"></a>
</p>

---

## 🌟 Executive Overview

**Chef Atelier** is a premium culinary workspace that transforms daily cooking into an art form. Seamlessly bridging smart technology and fine gastronomy, Chef Atelier acts as a professional, dedicated private chef right in your browser.

Powered by **Google Gemini 2.0 (via OpenRouter)**, Chef Atelier understands the ingredients in your pantry, generates 5-star recipes, guides your culinary techniques, and stores your cooking legacy. It features a fully-responsive, modern user interface, built to inspire home cooks to create masterpieces from what they already have.

---

## 📸 Interface Preview

<p align="center">
  <img src="image/Screenshot%202026-04-28%20100959.png" width="100%" alt="Chef Atelier App Screenshot" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.25);">
</p>

---

## 💎 Core Features

### 🧠 1. AI Culinary Assistant (Chef Atelier)
* **Dedicated Culinary AI**: Fully customized AI persona that rejects non-culinary topics, keeping conversations hyper-focused on recipes, cooking techniques, nutrition, and kitchen hacks.
* **Contextual Chat**: Automatically references your pantry inventory to suggest adjustments or replacements in real-time.
* **Gastronomy Output**: Recipes are dynamically parsed into premium styled cards with interactive checkboxes for ingredients and step-by-step guidance.

### 📦 2. Smart Pantry Manager
* **Inventory Tracking**: Add, update, and manage kitchen ingredients with specific quantities, units, and fresh/low stock status.
* **Dynamic Generation**: Select items in your pantry and generate an instant, custom gourmet recipe tailored specifically to those items.

### 📖 3. Personal Gastronomy Library
* **Bookmarks & Favorites**: Save generated recipes and keep track of important culinary chat sessions.
* **Interactive History**: Automatically groups previous culinary chats by date ("Hari Ini", "Kemarin", "Minggu Ini") to re-visit classic creations.

### 👥 4. Global Gastronomy Community
* **Interactive Dashboard**: Social space to share newly discovered recipe layouts, find inspiration, and collaborate with other users.

---

## 🛠️ Architecture & Tech Stack

| Component | Technology | Description |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 13.0 | Modern MVC foundation, routing, authentication, and database abstractions |
| **Language Runtime** | PHP 8.3 | High-performance, modern backend logic |
| **Frontend Styling** | Tailwind CSS & PostCSS | Elegant, glassmorphic utility-first styling and micro-animations |
| **Database** | Supabase (PostgreSQL) / SQLite | High-speed relational database storage for users, pantries, and chat sessions |
| **AI Integration** | Google Gemini 2.0 via OpenRouter | High-end generative intelligence producing structured, reliable culinary recipes |
| **Build Tooling** | Vite | Ultra-fast frontend compilation and Hot Module Replacement |

---

## 🚀 Getting Started

### Prerequisites
Make sure your system meets the following requirements:
* **PHP** `>= 8.3`
* **Composer** (PHP dependency manager)
* **Node.js** `>= 18.0` & **NPM**
* A database (SQLite, PostgreSQL, or a Supabase account)
* An OpenRouter API Key (to power the Gemini AI features)

### ⚡ One-Command Installation

We have prepared an automated setup script to bootstrap the application in seconds. Just run:

```bash
composer run setup
```

This single command will:
1. Install all PHP package dependencies via Composer.
2. Clone `.env.example` into a new `.env` configuration file.
3. Generate the application encryption key.
4. Run all database migrations.
5. Install NPM dependencies.
6. Compile all frontend assets for production.

---

## ⚙️ Environment Configuration

Open your newly generated `.env` file and set up your variables:

```ini
# Application configuration
APP_NAME="Chef Atelier"
APP_URL=http://localhost:8000

# Database Configuration (Supabase or SQLite)
DB_CONNECTION=sqlite
# For PostgreSQL/Supabase:
# DB_CONNECTION=pgsql
# DB_HOST=your-supabase-db-host.supabase.co
# DB_PORT=5432
# DB_DATABASE=postgres
# DB_USERNAME=postgres
# DB_PASSWORD=your-supabase-password

# OpenRouter AI Credentials (Crucial for AI chat and recipes)
OPENROUTER_API_KEY="your-openrouter-api-key-here"
OPENROUTER_MODEL="google/gemini-2.0-flash-lite-preview-02-05:free"
```

---

## 💻 Local Development Workflow

To launch the development server, queue listeners, and frontend assets compiler simultaneously, simply run:

```bash
npm run dev
# or
composer run dev
```

This initiates a unified developer workflow powered by `concurrently`:
* **Server**: Serves the application at `http://localhost:8000`
* **Queue**: Listens for background tasks and mails
* **Vite**: Hot reloads Javascript & CSS changes instantly
* **Logs**: Pipes Artisan Pail logs directly to your console

---

## 🛡️ License

This project is licensed under the MIT License. Feel free to use, modify, and build upon this project for your own smart kitchen.

---

<p align="center">
  Made with ❤️ by <a href="https://github.com/Abeyyyyyy">Abeyyyyyy</a> & <a href="https://github.com/gilannng">gilannng</a>.
</p>
