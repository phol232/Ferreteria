import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-sales',
  standalone: true,
  imports: [CommonModule],
  template: '<div class="card"><h2>Sales</h2><p class="muted">Módulo en preparación.</p></div>',
  styles: ['.muted{color:#6b7280}']
})
export class SalesComponent {}