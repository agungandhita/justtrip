Laravel Enterprise Development Rules

The Laravel Boost guidelines are specifically curated for this application to ensure Enterprise-level code quality. These guidelines must be followed strictly.

## 🛠 1. Tech Stack & Versions
- **Always verify:** Check `composer.json` for current versions before implementation.

## 🐘 2. PHP Strict Rules

### 📦 Data Transfer Objects (DTOs)
- **Rule:** If a method, constructor, or action requires **more than 4 parameters**, you **MUST** refactor it to a DTO.
- **Location:** `app/DTOs/{Domain}/{Feature}DTO.php`
- **Structure:** Use `readonly` properties and PHP 8.1+ constructor promotion.
- **Naming:** Must end with `DTO` suffix.
- **Example:** `app/DTOs/Users/CreateUserDTO.php`

### 🧬 Traits
- **Rule:** Use **ONLY** for horizontal reusability across multiple non-related classes.
- **Constraint:** Do not use Traits for vertical separation (splitting a single class into multiple files). Use Services or Actions instead.

### 🔢 Enums
- **Definition:** Use strict PHP 8.1+ backed Enums in `app/Enums`.
- **Naming:** Keys must be `TitleCase` (e.g., `UserStatus::Active`).
- **UI Helpers:** Enums **MUST** implement methods to return human-readable labels and UI colors.

## 🏗 3. Laravel Architecture Rules

### ⚙️ Services (The Only Source of Truth)
- **Zero Model Access in Controllers:** Controllers are **FORBIDDEN** from accessing Models directly. No `User::find()` in controllers.
- **Interface Injection:** Controllers **MUST** inject **Interfaces**, never concrete classes.
- **Binding:** Register all implementations in `app/Providers/ServiceRegistryProvider.php`.
- **Organization:** Group by Domain: `app/Services/Branch/BranchInterface.php`.

### 🗄 Database & Migrations
- **Primary Keys:** **ALL** tables must use UUIDs.
  - Migration: `$table->uuid('id')->primary();`
  - Model: Use `HasUuids` trait.
- **Enums in DB:**
  - **Never** use `$table->enum()`.
  - **Always** use `$table->string('column_name')`.
  - **Logic:** Handle the conversion in the Model using `casts`.
- **Query Safety:** 
  - **Never** use manual string interpolation: `where('name', 'ilike', "%{$search}%")`.
  - **Always** use `whereLike('name', $search)`.

### 📂 Models (The Logic Core)
- **Scopes:** Prioritize **Eloquent Local Scopes** (`scopeActive`, `scopeFilter`).
- **Organization:** Domain-driven folders: `app/Models/Attendance/Shift.php`.
- **Casting:** Use the `casts()` method for Enums and primitives.

### 🚦 Controllers (Zero-Query Policy)
- **Role:** Controllers are only "Traffic Cops".
- **Logic:** No business logic allowed. No `if` statements for business logic.
- **Validation:** **ALWAYS** use `FormRequest` classes.

## 🎨 4. Inertia & Vue 3 Rules

### 📜 Script Setup
- Use `<script setup lang="ts">`.
- Use **Composables** for logic if a component exceeds 200 lines.
- **Auto-Imports:** `ref`, `computed`, `watch`, `onMounted` are auto-imported. Do not explicitly import them.

### 🕹 Interaction
- Use `router` from `@inertiajs/vue3` for manual navigation.
- Use `useForm` for all form submissions.


## 5. Wayfinder (Route Types)

- **Development Skill:** Activate `wayfinder-development` when referencing routes.
- **Usage:** Import route functions from `@/actions` or `@/routes`.
    ```typescript
    import { store } from '@/actions/App/Http/Controllers/UserController';
    // ✅ GOOD: form.post(store.url());
    ```

## 🧪 6. Testing (Pest)
- **Philosophy:** Every logic change must be tested.
- **Tool:** Use `Pest PHP`.
- **Structure:** Favor Feature tests over Unit tests.

