import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-products',
  standalone: true,
  imports: [CommonModule, HttpClientModule],
  templateUrl: './products.component.html',
  styleUrl: './products.component.css'
})
export class ProductsComponent implements OnInit {
  product = {
    name: 'Table Virello', code: 'TBL-LEG', category: 'Furniture - Table', note: 'CL-09471',
    unit: 'unit', account: '12 - Goods', taxRate: 'VAT 5%', costPerUnit: 6.34, minStock: 0,
    active: true, trackQuantity: true, sell: true, pos: true, produce: false
  };
  rows = [
    { ref: 'SL-0-7-FF', date: '30/11/2025', qty: 4.5, price: 55.2, margin: '45.10%', cost: 300, total: 300 },
    { ref: 'SL-3-6-FF', date: '15/12/2025', qty: 2.75, price: 36.5, margin: '40.00%', cost: 150, total: 150 },
    { ref: 'SL-0-5-FF', date: '05/01/2026', qty: 5, price: 70.0, margin: '50.23%', cost: 400, total: 400 },
    { ref: 'SL-5-4-FF', date: '20/02/2026', qty: 3.2, price: 48.75, margin: '38.90%', cost: 250, total: 250 },
  ];

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    // Intento de carga desde el backend Laravel
    // Si el servidor Laravel no está levantado, el frontend seguirá mostrando los datos mock.
    this.http.get<any[]>('http://localhost:8000/api/productos').subscribe({
      next: (productos) => {
        if (productos && productos.length) {
          const p = productos[0];
          this.product = {
            name: p.nombreProducto ?? 'Producto',
            code: p.codigoProducto ?? '-',
            category: 'Categoría',
            note: 'N/A',
            unit: 'unit',
            account: '12 - Goods',
            taxRate: 'VAT 5%',
            costPerUnit: p.costoProducto ?? 0,
            minStock: p.cantidadProducto ?? 0,
            active: true,
            trackQuantity: true,
            sell: true,
            pos: true,
            produce: false
          };
        }
      },
      error: () => {
        // Silencio errores si el backend no está disponible
      }
    });
  }
}