---
trigger: always_on
---

# Laravel Rules

The Laravel Boost guidelines are specifically curated for this application to ensure Enterprise-level code quality. These guidelines must be followed strictly.

## 1. Tech Stack & Versions

- Selalu cek composer.json

## 2. PHP Rules (Strict)

### Data Transfer Objects (DTOs)

- **CRITICAL RULE:** If a method, constructor, or action requires **more than 4 parameters**, you **MUST** refactor it to use a Data Transfer Object (DTO).
- **Location:** Place DTOs in `app/DTOs`.
- **Organization:** Organize DTOs by **Domain/Feature** folder.
    - ✅ `app/DTOs/Users/CreateUserDTO.php`
    - ❌ `app/DTOs/CreateUserDTO.php`
- **Structure:** Use `readonly` properties and PHP 8 constructor promotion.
- **Naming:** Must end with `DTO` suffix (e.g., `CreateUserDTO`).

### Traits

- **Rule:** Extract logic into Traits **ONLY** when the behavior is reusable across multiple **non-related** classes (Horizontal Reusability).
- Do not use Traits just to make a class file smaller (Vertical Separation); use Services or Actions for that.

### Enums

- **Definition:** Create strict PHP 8.1+ backed Enums in `app/Enums`.
- **Naming:** Keys should be TitleCase. Example: `UserStatus::Active`.
- **UI Helpers:** Enums MUST implement methods to return human-readable labels and UI colors.

## 3. Laravel Architecture Rules

### Services (The Only Source of Truth)

- **Strict Rule 1 (Zero Model Access in Controller):** Controllers are **FORBIDDEN** from accessing Models directly. No `User::find()`, `User::where()`, etc. inside Controllers.
- **Strict Rule 2 (Interface Injection):** Controllers **MUST** inject **Interfaces**, NEVER Concrete Classes.
    - ❌ `public function __construct(UserService $service)`
    - ✅ `public function __construct(UserServiceInterface $service)`
- **Binding:** Register all Service implementations in `app/Providers/ServiceRegistryProvider.php`.
- **Organization:** Group Services and Interfaces by Domain.
    - `app/Services/Branch/BranchInterface.php`
    - `app/Services/Branch/BranchService.php`

### Database & Migrations

- **UUIDs:** ALL tables must use UUIDs as primary keys.
    - Migration: `$table->uuid('id')->primary();`
    - Model: Use `use Illuminate\Database\Eloquent\Concerns\HasUuids;`
- **Enums in DB:**
    - **NEVER** use `$table->enum()`.
    - **ALWAYS** use `$table->string('column_name')`.
    - **Logic:** Handle the conversion in the Model using `casts`.
- **Querying Safety:**
    - **NEVER** use manual string interpolation: `$q->where('name', 'ilike', "%{$search}%")`.
    - **ALWAYS** use the cleaner wrapper: `$q->whereLike('name', $search)`.

### Models (The Logic Core)

- **Scopes Priority:** Prioritize creating **Eloquent Local Scopes** (`scopeActive`, `scopeFilter`) for reusable query logic used by Services.
- **Organization (Domain Driven):** Group Models by Domain folder (`app/Models/Attendance/Shift.php`). Do not dump everything in root `Models/`.
- **Casting:** Use the `casts()` method to handle Enums and primitive types.

### Controllers (Zero-Query Policy)

- **Role:** Controllers should only act as "Traffic Cops" (Receive Request -> Call Service Interface -> Return Response).
- **Slimness:** No logic allowed. If there is an `if` statement for business logic, it belongs in the Service.
- **Validation:** ALWAYS use `FormRequest` classes.

## 4. Inertia & Vue 3 Rules

### Script Setup

- Use `<script setup lang="ts">`.
- Use **Composables** to extract logic if a component exceeds 200 lines.
- **Auto-Imports:** Assume `unplugin-auto-import` is active. Do not explicitly import `ref`, `computed`, `watch`, `onMounted`.

### Interaction

- Use `router` from `@inertiajs/vue3` for manual navigation/actions.
- Use `useForm` for all form submissions.

## 5. Wayfinder (Route Types)

- **Development Skill:** Activate `wayfinder-development` when referencing routes.
- **Usage:** Import route functions from `@/actions` or `@/routes`.
    ```typescript
    import { store } from '@/actions/App/Http/Controllers/UserController';
    // ✅ GOOD: form.post(store.url());
    ```

## 6. Testing (Pest)

- **Philosophy:** Every logic change must be tested.
- **Tool:** Use `Pest PHP`.
- **Structure:** Favor Feature tests over Unit tests.