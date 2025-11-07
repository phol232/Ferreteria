import { Routes } from '@angular/router';
import { LayoutComponent } from './layout/layout.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { authGuard, loginGuard } from './guards/auth.guard';

export const routes: Routes = [
  { 
    path: 'login', 
    loadComponent: () => import('./pages/auth/login.component').then(m => m.LoginComponent),
    canActivate: [loginGuard]
  },
  { 
    path: 'register', 
    loadComponent: () => import('./pages/auth/register.component').then(m => m.RegisterComponent),
    canActivate: [loginGuard]
  },
  {
    path: '',
    component: LayoutComponent,
    canActivate: [authGuard],
    children: [
      { path: '', pathMatch: 'full', redirectTo: 'dashboard' },
      { path: 'dashboard', component: DashboardComponent },
      { path: 'inventory/products', loadComponent: () => import('./pages/inventory/products/products-list.component').then(m => m.ProductsListComponent) },
      { path: 'suppliers', loadComponent: () => import('./pages/suppliers/suppliers-list.component').then(m => m.SuppliersListComponent) },
      { path: 'clients', loadComponent: () => import('./pages/clients/clients-list.component').then(m => m.ClientsListComponent) },
      { path: 'sales', loadComponent: () => import('./pages/sales/sales-list.component').then(m => m.SalesListComponent) },
    ]
  },
  { path: '**', redirectTo: 'login' }
];
