# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

SAPTO is a Laravel-based web application for managing "Tera and Ulang Tera" (calibration and re-calibration) workflows for UTTP (Ukuran, Takar, Timbang, dan Perlengkapannya - Measuring, Weighing, and Related Equipment). This is a government metrological service management system.

## Core Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Livewire 3 (full-stack reactive components)
- **UI Framework**: AdminLTE template with Tailwind CSS
- **Authentication**: Laravel Jetstream + Laravel Sanctum
- **Authorization**: Laratrust (role-based access control)
- **Database**: MySQL (configurable to SQLite)
- **Document Generation**: PHPWord (Word docs), Spatie Laravel PDF
- **Excel Export**: Maatwebsite Excel
- **Validation**: ProEngSoft Laravel JS Validation
- **Charts**: asantibanez/livewire-charts
- **Storage**: Spatie Laravel Google Cloud Storage

## Development Commands

### Setup
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed roles and permissions (if needed)
php artisan db:seed
```

### Development Server
```bash
# Start Laravel development server
php artisan serve

# Watch and compile frontend assets
npm run dev

# Build for production
npm run build
```

### Testing
```bash
# Run all tests
php artisan test
# or
vendor/bin/phpunit

# Run specific test suite
vendor/bin/phpunit --testsuite=Feature
vendor/bin/phpunit --testsuite=Unit
```

### Code Quality
```bash
# Format code with Laravel Pint
vendor/bin/pint

# Clear various caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan optimize
```

### Database
```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration (drops all tables)
php artisan migrate:fresh

# Fresh migration with seeders
php artisan migrate:fresh --seed
```

## Application Architecture

### Business Domain: Calibration Workflow

The system manages a multi-step calibration process:

1. **Pengajuan (Application/Request)**: Users submit requests for UTTP calibration
   - Types: Kantor-based (office-based) or Lokasi-based (on-site)
   - Status flow tracked via `ComCode` reference data
   - Auto-generated order numbers via `genNo()` helper

2. **Jadwal Tera (Calibration Schedule)**: Admin schedules calibration sessions
   - Assigns officers (`JadwalTeraPetugas`)
   - Assigns equipment (`JadwalTeraPeralatan`)
   - Links to approved applications

3. **Sidang Tera (Calibration Session)**: The actual calibration event
   - Participants tracked via `PesertaSidang` and `PesertaSidangUttp`
   - Multiple applications can be processed in one session

4. **Pemeriksaan (Examination)**: Detailed calibration examination
   - Standards used (`PemeriksaanStandar`)
   - Officers involved (`PemeriksaanPetugas`)
   - Methods and traceability (`Metode`, `Telusuran`)
   - Document generation (`DokumenPemeriksaan`)

5. **Berita Acara (Official Report)**: Final documentation and SKHP certificate generation

### Data Model Relationships

- **Pengajuan** (core entity):
  - `hasMany`: `PengajuanUttp` (items in application)
  - `belongsTo`: `User` (applicant), `JadwalTera` (assigned schedule), `ComCode` (type & status)
  - `hasOne`: `Pemeriksaan`

- **JadwalTera**:
  - `hasMany`: `JadwalTeraPeralatan`, `JadwalTeraPetugas`
  - `belongsTo`: `ComCode` (status)

- **Pemeriksaan**:
  - `belongsTo`: `Pengajuan`, `Metode`, `Telusuran`, `ComCode` (result status)
  - `hasMany`: `PemeriksaanStandar`, `PemeriksaanPetugas`

- **User**:
  - Extends Jetstream's User model with NIK, NIP, pangkat, pekerjaan
  - `hasMany`: `UttpUser` (user's registered equipment)
  - Uses Laratrust for role-based permissions

### Livewire Component Structure

Components are organized by access level:

- **Public/User Components** (`app/Livewire/`):
  - `Dashboard`, `DataDiri`, `UserUttpPage`
  - `Permohonan/PermohonanPage`, `Permohonan/PermohonanFormPage`
  - `ProsesPermohonanPage`, `DetailPermohonanPage`
  - `JadwalTera`, `JadwalTeraPeserta`, `DetailJadwalTera`

- **Admin Components** (`app/Livewire/Admin/`):
  - `Permohonan`, `PermohonanForm`
  - `SidangTera`, `SidangTeraForm`, `ProsesSidangTeraPage`
  - `SidangTeraBeritaAcara`

- **Master Data Components** (`app/Livewire/`):
  - `UserIndex`, `User`, `PemohonCrud`
  - `Uttp`, `Peralatan`, `Metode`, `Standar`, `Telusuran`
  - `TemplateDokumen`

- **Reusable Components** (`app/Livewire/Components/`):
  - `UserProfileComponent`, `ModalUser`, `ModalTambahUser`
  - `FormProsesComponent`, `FormPersetujuanComponent`
  - `InfoPengajuanComponent`, `InfoJadwalTera`, `UttpProsesComponent`
  - Badges: `PermohonanBadges`, `PermohonanKantorBadges`, `PermohonanLokoBadges`

- **Charts** (`app/Livewire/Chart/`):
  - `PermohonanChart`, `UttpChart`

### Helper Functions

Located in `app/Helpers/General.php` (autoloaded via composer.json):

- `genNo()`: Generates sequential order numbers in format `YYYY-####`
- `konversi_nomor($nohp)`: Converts Indonesian phone numbers to international format (+62)

### Reference Data (ComCode)

The `ComCode` model serves as a central reference data table for various status and type fields:
- Application types (`pengajuan_tp`): PENGAJUAN_TP_01 (office), PENGAJUAN_TP_02 (on-site)
- Application status (`pengajuan_st`)
- Schedule status (`jadwal_tera_st`)
- Examination result status (`hasil_st`)

### Document Management

Documents are stored and generated in multiple formats:
- **Uploads**: Surat permohonan, surat tugas, cerapan (scan files)
- **Generated**: SKHP certificates (PDF), Berita Acara (Word/PDF)
- **Templates**: `TemplateDokumen` model stores document templates
- Export functionality via `app/Exports/` classes: `GlobalExport`, `TriwulanExport`, `SidangTeraExport`, `RekapPertanggalExport`

### Controller Usage

Most UI is Livewire-based. Traditional controllers are used for:
- `CetakController`: Document generation endpoints (SKHP, BA, Order)
- `LaporanController`: Report generation (rekap, triwulan, global, sidang)
- `HelperController`: Utility endpoints (show uploaded pictures)
- `RegisterController`: Public registration
- `PasswordResetController`: Password reset flow

### Authentication & Authorization

- Jetstream handles user authentication
- Laratrust manages role-based permissions
- Routes are protected via `auth:sanctum` middleware
- Admin routes use `/admin` prefix
- Master data routes use `/master` prefix

### Frontend & Assets

- Vite for asset bundling (see `vite.config.js`)
- Tailwind CSS configuration in `tailwind.config.js`
- AdminLTE template assets in `public/AdminLTE/`
- Main layout: `resources/views/layouts/app.blade.php`
- Livewire views follow component structure

## Common Development Patterns

### Creating New Livewire Components

```bash
# Create component with view
php artisan make:livewire ComponentName

# For nested components (e.g., Admin namespace)
php artisan make:livewire Admin/ComponentName
```

### Adding New Models

1. Create migration: `php artisan make:migration create_tablename_table`
2. Define schema in migration file
3. Create model: `php artisan make:model ModelName`
4. Define `$guarded = []` or `$fillable` for mass assignment
5. Define relationships in model
6. Run migration: `php artisan migrate`

### Working with Routes

- Add routes in `routes/web.php`
- Use route groups for prefix/middleware
- Livewire components use `Route::get('path', ComponentClass::class)->name('route.name')`

### Working with Permissions

This project uses Laratrust. Check user permissions in controllers/components:
```php
if ($user->hasRole('admin')) { ... }
if ($user->can('create-permohonan')) { ... }
```

## Important File Locations

- **Models**: `app/Models/`
- **Livewire Components**: `app/Livewire/`
- **Controllers**: `app/Http/Controllers/`
- **Helpers**: `app/Helpers/General.php` (autoloaded)
- **Migrations**: `database/migrations/`
- **Routes**: `routes/web.php`, `routes/api.php`
- **Views**: `resources/views/`
- **Livewire Views**: `resources/views/livewire/`
- **Config**: `config/`
- **Exports**: `app/Exports/`
- **Actions**: `app/Actions/Fortify/`, `app/Actions/Jetstream/`
