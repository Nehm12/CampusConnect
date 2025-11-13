# 🏫 CampusConnect - Module 2 Frontend

## 📋 Vue d'ensemble

Ce document décrit le **frontend du Module 2 (Réservations)** développé pour CampusConnect.

## 🎯 Pages développées

### 1. Dashboard Réservations (`/reservations`)
- **Fichier** : `resources/views/reservations/index.blade.php`
- **Fonctionnalités** :
  - Cards de statistiques
  - Actions rapides
  - Tableau des réservations récentes
  - Navigation vers les autres pages

### 2. Créer une réservation (`/reservations/create`)
- **Fichier** : `resources/views/reservations/create.blade.php`
- **Fonctionnalités** :
  - Formulaire en 3 étapes (Salle → Horaires → Matériel)
  - Sélection interactive des salles
  - Validation JavaScript
  - Feedback visuel en temps réel

### 3. Consulter disponibilités (`/reservations/availability`)
- **Fichier** : `resources/views/reservations/availability.blade.php`
- **Fonctionnalités** :
  - Filtres par date/heure/durée
  - Vue des salles disponibles
  - État du matériel en temps réel
  - Planning visuel avec timeline

### 4. Mes réservations (`/reservations/my-reservations`)
- **Fichier** : `resources/views/reservations/my-reservations.blade.php`
- **Fonctionnalités** :
  - Historique complet des réservations
  - Filtres par statut et date
  - Actions contextuelles (modifier, annuler)
  - Pagination

### 5. Admin - Validation (`/admin/reservations`)
- **Fichier** : `resources/views/admin/reservations/index.blade.php`
- **Fonctionnalités** :
  - Gestion des demandes en attente
  - Détection automatique de conflits
  - Approbation/rejet avec modals
  - Statistiques administrateur
  - Historique des actions

## 🎨 Composants réutilisables

### Layout principal
- **Fichier** : `resources/views/layouts/reservations.blade.php`
- **Fonctionnalités** :
  - Navigation responsive
  - Menu mobile hamburger
  - Mode sombre/clair automatique
  - Breadcrumbs contextuels

### Composants UI
- **Modal** : `resources/views/components/modal.blade.php`
- **Notifications** : `resources/views/components/notification.blade.php`

## 🛠 Technologies utilisées

- **Framework** : Laravel 12 (Blade templates)
- **CSS** : Tailwind CSS (via CDN)
- **Icons** : Lucide Icons
- **JavaScript** : Vanilla JS (interactions)
- **Responsive** : Mobile-first design

## 🚀 Installation et test

### Prérequis
```bash
# Dépendances installées
composer install
cp .env.example .env
php artisan key:generate
```

### Configuration
```bash
# Dans .env
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

### Lancement
```bash
php artisan serve
```

### URLs de test
- Dashboard : `http://127.0.0.1:8000/reservations`
- Créer : `http://127.0.0.1:8000/reservations/create`
- Disponibilités : `http://127.0.0.1:8000/reservations/availability`
- Historique : `http://127.0.0.1:8000/reservations/my-reservations`
- Admin : `http://127.0.0.1:8000/admin/reservations`

## 🔗 Intégration Backend

### Routes temporaires
Les routes sont actuellement définies dans `routes/web.php` (lignes 8-35) avec des closures temporaires.

### Remplacement pour l'intégration
```php
// Remplacer ceci (temporaire) :
Route::get('/create', function () {
    return view('reservations.create');
});

// Par ceci (final) :
Route::get('/create', [ReservationController::class, 'create']);
```

### Données attendues
Les vues utilisent actuellement des **données fictives**. Voici les variables attendues :

#### Dashboard (`reservations.index`)
```php
return view('reservations.index', [
    'stats' => [
        'active' => 3,
        'pending' => 2,
        'approved' => 12,
        'rejected' => 1
    ],
    'recent_reservations' => $reservations
]);
```

#### Disponibilités (`reservations.availability`)
```php
return view('reservations.availability', [
    'rooms' => $availableRooms,
    'equipment' => $availableEquipment,
    'timeline' => $daySchedule
]);
```

## 📱 Fonctionnalités interactives

### JavaScript inclus
- Sélection interactive des salles
- Validation de formulaires
- Modals de confirmation
- Notifications toast
- Menu mobile responsive
- Animations et transitions

### Accessibilité
- Navigation au clavier
- ARIA labels
- Focus management
- Contraste respecté
- Responsive design

## 🎯 Points d'attention pour l'équipe

### 1. Structure des fichiers
```
resources/views/
├── layouts/reservations.blade.php    # Layout principal
├── reservations/                     # Pages module 2
│   ├── index.blade.php              # Dashboard
│   ├── create.blade.php             # Formulaire
│   ├── availability.blade.php       # Disponibilités
│   └── my-reservations.blade.php    # Historique
├── admin/reservations/
│   └── index.blade.php              # Validation admin
└── components/                       # Composants réutilisables
    ├── modal.blade.php
    └── notification.blade.php
```

### 2. Classes CSS importantes
- `.room-card` : Cards de sélection de salles
- `.modal` : Système de modals
- `.notification` : Système de notifications
- `.mobile-menu` : Menu mobile

### 3. IDs JavaScript
- `#approve-modal`, `#reject-modal` : Modals admin
- `#success-notification`, `#error-notification` : Notifications
- `#reservation-form` : Formulaire principal

## 🔧 Maintenance

### Ajout d'une nouvelle page
1. Créer le fichier dans `resources/views/reservations/`
2. Ajouter la route dans `routes/web.php`
3. Ajouter le lien dans le layout navigation

### Modification du design
- Toutes les classes Tailwind sont utilisées
- Mode sombre géré automatiquement
- Responsive breakpoints : `sm:`, `md:`, `lg:`

## 📞 Support

Pour toute question sur l'intégration frontend :
- Structure des vues : Bien documentée dans les fichiers
- Données attendues : Voir section "Intégration Backend"
- Composants : Réutilisables et modulaires

---

**Développé par** : [Votre nom]  
**Date** : Novembre 2024  
**Version** : 1.0