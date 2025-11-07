import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterLink],
  template: `
    <div class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-indigo-100 flex items-center justify-center p-4">
      <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl mb-4 shadow-lg">
            <span class="text-2xl font-bold text-white">SC</span>
          </div>
          <h1 class="text-3xl font-bold text-gray-900">SocioConstructor</h1>
          <p class="text-gray-600 mt-2">Sistema de Gestión Empresarial</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
          <h2 class="text-2xl font-bold text-gray-900 mb-6">Iniciar Sesión</h2>
          
          <form (ngSubmit)="onLogin()" class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Correo Electrónico
              </label>
              <input type="email" 
                     [(ngModel)]="email" 
                     name="email"
                     required
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                     placeholder="tu@email.com">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Contraseña
              </label>
              <input type="password" 
                     [(ngModel)]="password" 
                     name="password"
                     required
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                     placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between">
              <label class="flex items-center">
                <input type="checkbox" 
                       [(ngModel)]="rememberMe" 
                       name="rememberMe"
                       class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                <span class="ml-2 text-sm text-gray-600">Recordarme</span>
              </label>
              <a href="#" class="text-sm text-sky-600 hover:text-sky-700 font-medium">
                ¿Olvidaste tu contraseña?
              </a>
            </div>

            <button type="submit" 
                    [disabled]="loading"
                    class="w-full py-3 px-4 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold rounded-lg shadow-md transition-all disabled:opacity-50 disabled:cursor-not-allowed">
              <span *ngIf="!loading">Iniciar Sesión</span>
              <span *ngIf="loading" class="flex items-center justify-center">
                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Iniciando...
              </span>
            </button>
          </form>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              ¿No tienes una cuenta? 
              <a routerLink="/register" class="text-sky-600 hover:text-sky-700 font-semibold">
                Regístrate aquí
              </a>
            </p>
          </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-600">
          <p>© 2025 SocioConstructor. Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
  `
})
export class LoginComponent {
  email: string = '';
  password: string = '';
  rememberMe: boolean = false;
  loading: boolean = false;

  constructor(private router: Router) {}

  onLogin() {
    if (!this.email || !this.password) {
      alert('Por favor complete todos los campos');
      return;
    }

    this.loading = true;

    // Simulate login (replace with actual API call)
    setTimeout(() => {
      localStorage.setItem('isLoggedIn', 'true');
      localStorage.setItem('userEmail', this.email);
      this.router.navigate(['/']);
      this.loading = false;
    }, 1000);
  }
}
