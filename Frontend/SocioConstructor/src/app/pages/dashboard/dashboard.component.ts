import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ApiService } from '../../services/api.service';
import { HttpClientModule } from '@angular/common/http';
import { forkJoin } from 'rxjs';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [CommonModule, HttpClientModule],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent implements OnInit {
  stats = {
    totalProducts: 0,
    totalClients: 0,
    totalSuppliers: 0,
    totalSales: 0,
    totalRevenue: 0,
    lowStockProducts: 0
  };

  recentActivities: any[] = [];
  topProducts: any[] = [];
  loading = true;

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadDashboardData();
  }

  loadDashboardData() {
    forkJoin({
      products: this.apiService.getProductos(),
      clients: this.apiService.getClientes(),
      suppliers: this.apiService.getProveedores(),
      sales: this.apiService.getVentas()
    }).subscribe({
      next: (data) => {
        this.stats.totalProducts = data.products.length;
        this.stats.totalClients = data.clients.length;
        this.stats.totalSuppliers = data.suppliers.length;
        this.stats.totalSales = data.sales.length;
        
        // Calculate total revenue
        this.stats.totalRevenue = data.sales.reduce((sum, sale) => sum + (sale.totalVenta || 0), 0);
        
        // Low stock products (less than 10 units)
        this.stats.lowStockProducts = data.products.filter(p => p.cantidadProducto < 10).length;
        
        // Combine all activities
        const activities: any[] = [];
        
        // Add sales (use created_at or fechaVenta)
        data.sales.forEach(sale => {
          const date = sale.created_at || sale.fechaVenta || sale.updated_at;
          if (date) {
            activities.push({
              type: 'sale',
              icon: 'sale',
              color: 'green',
              title: 'Nueva venta creada',
              description: `${sale.cliente?.nombreCliente || 'Cliente'} - S/ ${sale.totalVenta}`,
              date: date,
              timestamp: new Date(date).getTime()
            });
          }
        });
        
        // Add products
        data.products.forEach(product => {
          const date = product.created_at || product.updated_at;
          if (date) {
            activities.push({
              type: 'product',
              icon: 'product',
              color: 'blue',
              title: 'Producto agregado',
              description: `${product.nombreProducto} - Stock: ${product.cantidadProducto}`,
              date: date,
              timestamp: new Date(date).getTime()
            });
          }
        });
        
        // Add clients
        data.clients.forEach(client => {
          const date = client.created_at || client.updated_at;
          if (date) {
            activities.push({
              type: 'client',
              icon: 'client',
              color: 'purple',
              title: 'Cliente agregado',
              description: `${client.nombreCliente} ${client.apellidosCliente || ''}`,
              date: date,
              timestamp: new Date(date).getTime()
            });
          }
        });
        
        // Add suppliers
        data.suppliers.forEach(supplier => {
          const date = supplier.created_at || supplier.updated_at;
          if (date) {
            activities.push({
              type: 'supplier',
              icon: 'supplier',
              color: 'amber',
              title: 'Proveedor agregado',
              description: `${supplier.razonSocial || supplier.nombreProveedor}`,
              date: date,
              timestamp: new Date(date).getTime()
            });
          }
        });
        
        // Sort by timestamp (most recent first) and take top 8
        this.recentActivities = activities
          .filter(a => a.timestamp && !isNaN(a.timestamp))
          .sort((a, b) => b.timestamp - a.timestamp)
          .slice(0, 8);
        
        console.log('Recent activities:', this.recentActivities);
        
        // Top products by price
        this.topProducts = data.products
          .sort((a, b) => b.precioProducto - a.precioProducto)
          .slice(0, 4);
        
        this.loading = false;
      },
      error: (err) => {
        console.error('Error loading dashboard data:', err);
        this.loading = false;
      }
    });
  }

  formatDate(date: string): string {
    const now = new Date();
    const activityDate = new Date(date);
    const diffTime = Math.abs(now.getTime() - activityDate.getTime());
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    const diffHours = Math.ceil(diffTime / (1000 * 60 * 60));
    
    if (diffHours < 1) return 'Hace unos minutos';
    if (diffHours < 24) return `Hace ${diffHours}h`;
    if (diffDays === 1) return 'Ayer';
    if (diffDays < 7) return `Hace ${diffDays}d`;
    return activityDate.toLocaleDateString('es-PE');
  }

  getActivityIcon(icon: string): string {
    const icons: any = {
      sale: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
      product: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
      client: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
      supplier: 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'
    };
    return icons[icon] || icons.product;
  }

  getActivityColorClass(color: string): string {
    const colors: any = {
      green: 'bg-green-100 text-green-600',
      blue: 'bg-blue-100 text-blue-600',
      purple: 'bg-purple-100 text-purple-600',
      amber: 'bg-amber-100 text-amber-600'
    };
    return colors[color] || colors.blue;
  }
}