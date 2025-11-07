import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterOutlet, RouterLink, RouterLinkActive, Router } from '@angular/router';

@Component({
  selector: 'app-layout',
  standalone: true,
  imports: [CommonModule, RouterOutlet, RouterLink, RouterLinkActive],
  templateUrl: './layout.component.html',
  styleUrl: './layout.component.css'
})
export class LayoutComponent {
  inventoryOpen = true;

  constructor(private router: Router) {}

  toggleInventory() {
    this.inventoryOpen = !this.inventoryOpen;
  }

  logout() {
    if (confirm('¿Está seguro de cerrar sesión?')) {
      localStorage.removeItem('isLoggedIn');
      localStorage.removeItem('userEmail');
      localStorage.removeItem('userName');
      this.router.navigate(['/login']);
    }
  }

  getUserName(): string {
    return localStorage.getItem('userName') || 'Usuario';
  }

  getUserEmail(): string {
    return localStorage.getItem('userEmail') || 'usuario@email.com';
  }

  getUserInitials(): string {
    const name = this.getUserName();
    const parts = name.split(' ');
    if (parts.length >= 2) {
      return (parts[0][0] + parts[1][0]).toUpperCase();
    }
    return name.substring(0, 2).toUpperCase();
  }
}