import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../../services/api.service';
import { HttpClientModule } from '@angular/common/http';
import { ModalComponent } from '../../shared/modal/modal.component';

interface CartItem {
  producto: any;
  cantidad: number;
  subtotal: number;
  total: number;
}

@Component({
  selector: 'app-sales-list',
  standalone: true,
  imports: [CommonModule, HttpClientModule, FormsModule, ModalComponent],
  template: `
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Nueva Venta</h1>
          <p class="text-sm text-gray-500 mt-1">Selecciona productos y procesa la venta</p>
        </div>
        <button (click)="viewSalesHistory()" 
                class="flex items-center gap-2 px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors shadow-sm">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          Historial de Ventas
        </button>
      </div>

      <div class="grid grid-cols-12 gap-6">
        <!-- Products List - Left Side -->
        <div class="col-span-8 space-y-4">
          <!-- Search -->
          <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="relative">
              <input type="search" 
                     [(ngModel)]="searchTerm"
                     (ngModelChange)="filterProducts()"
                     placeholder="Buscar productos..." 
                     class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500">
              <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
          </div>

          <!-- Products Grid -->
          <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="font-semibold text-gray-900 mb-4">Productos Disponibles</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-[600px] overflow-y-auto">
              <div *ngFor="let product of filteredProducts" 
                   class="border border-gray-200 rounded-lg p-3 hover:border-sky-300 transition-colors">
                <div class="aspect-square bg-gradient-to-br from-sky-50 to-blue-50 rounded-lg mb-2 flex items-center justify-center">
                  <img *ngIf="product.imageProducto && product.imageProducto !== ''" 
                       [src]="product.imageProducto" 
                       [alt]="product.nombreProducto"
                       class="w-full h-full object-cover rounded-lg"
                       (error)="$any($event.target).style.display='none'">
                  <svg *ngIf="!product.imageProducto || product.imageProducto === ''" 
                       class="w-12 h-12 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                  </svg>
                </div>
                <h4 class="font-semibold text-sm text-gray-900 truncate mb-1">{{product.nombreProducto}}</h4>
                <p class="text-xs text-gray-500 mb-2">Stock: {{product.cantidadProducto}}</p>
                <div class="flex items-center justify-between mb-2">
                  <span class="text-sm font-bold text-sky-600">S/ {{product.precioProducto}}</span>
                </div>
                <button (click)="addToCart(product)" 
                        [disabled]="product.cantidadProducto <= 0"
                        [class.opacity-50]="product.cantidadProducto <= 0"
                        [class.cursor-not-allowed]="product.cantidadProducto <= 0"
                        class="w-full px-3 py-1.5 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-sm font-medium transition-colors disabled:hover:bg-sky-500">
                  <span *ngIf="product.cantidadProducto > 0">Agregar</span>
                  <span *ngIf="product.cantidadProducto <= 0">Sin Stock</span>
                </button>
              </div>

              <div *ngIf="filteredProducts.length === 0" class="col-span-full text-center py-12">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <p class="text-sm text-gray-500">No se encontraron productos</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Shopping Cart - Right Side -->
        <div class="col-span-4">
          <div class="bg-white rounded-lg border border-gray-200 p-4 sticky top-4">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
              Carrito de Compras
            </h3>

            <!-- Client Selection -->
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Cliente *</label>
              <select [(ngModel)]="selectedClientId" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 text-sm">
                <option value="">Seleccione un cliente</option>
                <option *ngFor="let client of clients" [value]="client.id">
                  {{client.nombreCliente}} {{client.apellidosCliente}}
                </option>
              </select>
            </div>

            <!-- Cart Items -->
            <div class="space-y-2 mb-4 max-h-[300px] overflow-y-auto">
              <div *ngFor="let item of cart" 
                   class="border border-gray-200 rounded-lg p-3">
                <div class="flex items-start justify-between mb-2">
                  <div class="flex-1">
                    <h4 class="font-medium text-sm text-gray-900">{{item.producto.nombreProducto}}</h4>
                    <p class="text-xs text-gray-500">S/ {{item.producto.precioProducto}} c/u</p>
                  </div>
                  <button (click)="removeFromCart(item)" 
                          class="text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <button (click)="decreaseQuantity(item)" 
                            class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded text-gray-700 font-bold">
                      -
                    </button>
                    <span class="w-8 text-center font-medium text-sm">{{item.cantidad}}</span>
                    <button (click)="increaseQuantity(item)" 
                            [disabled]="item.cantidad >= item.producto.cantidadProducto"
                            class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded text-gray-700 font-bold disabled:opacity-50 disabled:cursor-not-allowed">
                      +
                    </button>
                  </div>
                  <span class="font-semibold text-sm text-gray-900">S/ {{item.total.toFixed(2)}}</span>
                </div>
              </div>

              <div *ngIf="cart.length === 0" class="text-center py-8">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-sm text-gray-400">Carrito vacío</p>
              </div>
            </div>

            <!-- Totals -->
            <div class="border-t border-gray-200 pt-4 space-y-2">
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">Subtotal:</span>
                <span class="font-medium">S/ {{getSubtotal().toFixed(2)}}</span>
              </div>
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">IGV (18%):</span>
                <span class="font-medium">S/ {{getIGV().toFixed(2)}}</span>
              </div>
              <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-2">
                <span>Total:</span>
                <span class="text-sky-600">S/ {{getTotal().toFixed(2)}}</span>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 space-y-2">
              <button (click)="processSale()" 
                      [disabled]="cart.length === 0 || !selectedClientId || processing"
                      class="w-full px-4 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-green-500">
                <span *ngIf="!processing">Procesar Venta</span>
                <span *ngIf="processing">Procesando...</span>
              </button>
              <button (click)="clearCart()" 
                      [disabled]="cart.length === 0"
                      class="w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                Limpiar Carrito
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sales History Modal -->
    <app-modal [isOpen]="showHistoryModal" 
               title="Historial de Ventas"
               confirmText="Cerrar"
               (confirmed)="closeHistoryModal()"
               (closed)="closeHistoryModal()">
      <div class="space-y-4">
        <div class="overflow-x-auto max-h-[500px]">
          <table class="w-full text-sm">
            <thead class="bg-gray-50 sticky top-0">
              <tr>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">ID</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">Fecha</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">Cliente</th>
                <th class="px-4 py-2 text-right text-xs font-semibold text-gray-600">Total</th>
                <th class="px-4 py-2 text-center text-xs font-semibold text-gray-600">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr *ngFor="let sale of salesHistory" class="hover:bg-gray-50">
                <td class="px-4 py-3 font-mono text-xs">#{{sale.id}}</td>
                <td class="px-4 py-3">{{formatDate(sale.fechaVenta)}}</td>
                <td class="px-4 py-3">{{sale.cliente?.nombreCliente || 'N/A'}}</td>
                <td class="px-4 py-3 text-right font-semibold">S/ {{sale.totalVenta}}</td>
                <td class="px-4 py-3 text-center">
                  <button (click)="viewSaleDetails(sale)" 
                          class="text-sky-600 hover:text-sky-800">
                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </button>
                </td>
              </tr>
              <tr *ngIf="salesHistory.length === 0">
                <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                  No hay ventas registradas
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </app-modal>

    <!-- Sale Details Modal -->
    <app-modal [isOpen]="showDetailsModal" 
               title="Detalles de la Venta"
               confirmText="Cerrar"
               (confirmed)="closeDetailsModal()"
               (closed)="closeDetailsModal()">
      <div *ngIf="selectedSale" class="space-y-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
          <div>
            <span class="text-gray-600">ID Venta:</span>
            <span class="font-semibold ml-2">#{{selectedSale.id}}</span>
          </div>
          <div>
            <span class="text-gray-600">Fecha:</span>
            <span class="font-semibold ml-2">{{formatDate(selectedSale.fechaVenta)}}</span>
          </div>
          <div class="col-span-2">
            <span class="text-gray-600">Cliente:</span>
            <span class="font-semibold ml-2">{{selectedSale.cliente?.nombreCliente || 'N/A'}}</span>
          </div>
        </div>

        <div class="border-t border-gray-200 pt-4">
          <h4 class="font-semibold mb-3">Productos:</h4>
          <div class="space-y-2">
            <div *ngFor="let detalle of selectedSale.detalles" 
                 class="flex justify-between items-center text-sm border-b border-gray-100 pb-2">
              <div>
                <p class="font-medium">{{detalle.producto?.nombreProducto || 'Producto'}}</p>
                <p class="text-xs text-gray-500">Cantidad: {{detalle.cantidadDetalleVenta}}</p>
              </div>
              <span class="font-semibold">S/ {{detalle.totalDetalleVenta}}</span>
            </div>
          </div>
        </div>

        <div class="border-t border-gray-200 pt-4 space-y-2">
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Subtotal:</span>
            <span class="font-medium">S/ {{selectedSale.subtotalVenta}}</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">IGV:</span>
            <span class="font-medium">S/ {{selectedSale.igvVenta}}</span>
          </div>
          <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-2">
            <span>Total:</span>
            <span class="text-sky-600">S/ {{selectedSale.totalVenta}}</span>
          </div>
        </div>
      </div>
    </app-modal>
  `
})
export class SalesListComponent implements OnInit {
  products: any[] = [];
  filteredProducts: any[] = [];
  clients: any[] = [];
  cart: CartItem[] = [];
  selectedClientId: string = '';
  searchTerm: string = '';
  processing: boolean = false;
  salesHistory: any[] = [];
  showHistoryModal: boolean = false;
  showDetailsModal: boolean = false;
  selectedSale: any = null;

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadProducts();
    this.loadClients();
  }

  loadProducts() {
    this.apiService.getProductos().subscribe({
      next: (data) => {
        this.products = data;
        this.filteredProducts = data;
      },
      error: () => {
        this.products = [];
        this.filteredProducts = [];
      }
    });
  }

  loadClients() {
    this.apiService.getClientes().subscribe({
      next: (data) => this.clients = data,
      error: () => this.clients = []
    });
  }

  loadSalesHistory() {
    this.apiService.getVentas().subscribe({
      next: (data) => this.salesHistory = data,
      error: () => this.salesHistory = []
    });
  }

  filterProducts() {
    if (!this.searchTerm) {
      this.filteredProducts = this.products;
      return;
    }
    const term = this.searchTerm.toLowerCase();
    this.filteredProducts = this.products.filter(p => 
      p.nombreProducto.toLowerCase().includes(term) ||
      p.codigoProducto.toLowerCase().includes(term)
    );
  }

  addToCart(product: any) {
    const existingItem = this.cart.find(item => item.producto.id === product.id);
    
    if (existingItem) {
      if (existingItem.cantidad < product.cantidadProducto) {
        existingItem.cantidad++;
        this.updateCartItem(existingItem);
      }
    } else {
      const newItem: CartItem = {
        producto: product,
        cantidad: 1,
        subtotal: product.precioProducto,
        total: product.precioProducto
      };
      this.cart.push(newItem);
    }
  }

  increaseQuantity(item: CartItem) {
    if (item.cantidad < item.producto.cantidadProducto) {
      item.cantidad++;
      this.updateCartItem(item);
    }
  }

  decreaseQuantity(item: CartItem) {
    if (item.cantidad > 1) {
      item.cantidad--;
      this.updateCartItem(item);
    }
  }

  updateCartItem(item: CartItem) {
    item.subtotal = item.producto.precioProducto * item.cantidad;
    item.total = item.subtotal;
  }

  removeFromCart(item: CartItem) {
    const index = this.cart.indexOf(item);
    if (index > -1) {
      this.cart.splice(index, 1);
    }
  }

  clearCart() {
    if (confirm('¿Está seguro de limpiar el carrito?')) {
      this.cart = [];
    }
  }

  getSubtotal(): number {
    return this.cart.reduce((sum, item) => sum + item.subtotal, 0);
  }

  getIGV(): number {
    return this.getSubtotal() * 0.18;
  }

  getTotal(): number {
    return this.getSubtotal() + this.getIGV();
  }

  processSale() {
    if (!this.selectedClientId || this.cart.length === 0) {
      alert('Por favor seleccione un cliente y agregue productos al carrito');
      return;
    }

    this.processing = true;

    const subtotal = this.getSubtotal();
    const igv = this.getIGV();
    const total = this.getTotal();
    const ganancias = this.cart.reduce((sum, item) => 
      sum + (item.producto.gananciaProducto * item.cantidad), 0
    );

    const saleData = {
      idCliente: parseInt(this.selectedClientId),
      subtotalVenta: subtotal,
      gananciasVenta: ganancias,
      igvVenta: igv,
      totalVenta: total,
      fechaVenta: new Date().toISOString().split('T')[0],
      detalles: this.cart.map(item => ({
        idProducto: item.producto.id,
        cantidadDetalleVenta: item.cantidad,
        subtotalDetalleVenta: item.subtotal,
        totalDetalleVenta: item.total
      }))
    };

    this.apiService.createVenta(saleData).subscribe({
      next: () => {
        alert('¡Venta procesada exitosamente!');
        this.cart = [];
        this.selectedClientId = '';
        this.loadProducts(); // Reload to update stock
        this.processing = false;
      },
      error: (err) => {
        console.error('Error processing sale:', err);
        alert('Error al procesar la venta');
        this.processing = false;
      }
    });
  }

  viewSalesHistory() {
    this.loadSalesHistory();
    this.showHistoryModal = true;
  }

  closeHistoryModal() {
    this.showHistoryModal = false;
  }

  viewSaleDetails(sale: any) {
    this.selectedSale = sale;
    this.showDetailsModal = true;
  }

  closeDetailsModal() {
    this.showDetailsModal = false;
    this.selectedSale = null;
  }

  formatDate(date: string): string {
    return new Date(date).toLocaleDateString('es-PE', { 
      year: 'numeric', 
      month: 'short', 
      day: 'numeric' 
    });
  }
}
