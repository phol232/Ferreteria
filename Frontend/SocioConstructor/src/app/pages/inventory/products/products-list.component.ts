import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../../../services/api.service';
import { HttpClientModule } from '@angular/common/http';
import { ModalComponent } from '../../../shared/modal/modal.component';

@Component({
  selector: 'app-products-list',
  standalone: true,
  imports: [CommonModule, RouterLink, HttpClientModule, FormsModule, ModalComponent],
  template: `
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Productos</h1>
          <p class="text-sm text-gray-500 mt-1">Gestiona tu inventario de productos</p>
        </div>
        <button (click)="openCreateModal()" 
                class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600 text-white rounded-lg font-medium transition-colors shadow-sm">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Agregar Producto
        </button>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Total Productos</p>
              <p class="text-2xl font-bold text-gray-900 mt-1">{{products.length}}</p>
            </div>
            <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">En Stock</p>
              <p class="text-2xl font-bold text-green-600 mt-1">{{getTotalStock()}}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Stock Bajo</p>
              <p class="text-2xl font-bold text-amber-600 mt-1">{{getLowStockCount()}}</p>
            </div>
            <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Valor Total</p>
              <p class="text-2xl font-bold text-gray-900 mt-1">S/ {{getTotalValue().toFixed(2)}}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Products Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        <div *ngFor="let product of products" 
             class="group bg-white rounded-lg border border-gray-200 hover:border-sky-300 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
          <!-- Product Image -->
          <div class="relative h-32 bg-gradient-to-br from-sky-50 via-blue-50 to-indigo-50 flex items-center justify-center overflow-hidden">
            <img *ngIf="product.imageProducto && product.imageProducto !== 'default.png' && product.imageProducto !== ''" 
                 [src]="product.imageProducto" 
                 [alt]="product.nombreProducto"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                 (error)="$any($event.target).style.display='none'">
            <div *ngIf="!product.imageProducto || product.imageProducto === 'default.png' || product.imageProducto === ''" 
                 class="w-12 h-12 bg-gradient-to-br from-sky-400 via-blue-500 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
            </div>
            <!-- Stock Badge -->
            <div class="absolute top-2 right-2">
              <span [class]="product.cantidadProducto < 10 ? 'bg-amber-500 text-white' : 'bg-green-500 text-white'" 
                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold shadow-md">
                {{product.cantidadProducto}}
              </span>
            </div>
          </div>

          <!-- Product Info -->
          <div class="p-3">
            <div class="mb-2">
              <h3 class="font-semibold text-sm text-gray-900 truncate">{{product.nombreProducto}}</h3>
              <p class="text-xs text-gray-500 font-mono">{{product.codigoProducto}}</p>
            </div>
            
            <!-- Price Section -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-2 mb-2">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-xs text-gray-500">Costo</p>
                  <p class="text-sm font-bold text-gray-900">S/ {{product.costoProducto}}</p>
                </div>
                <div class="text-right">
                  <p class="text-xs text-gray-500">Precio</p>
                  <p class="text-sm font-bold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">S/ {{product.precioProducto}}</p>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-1.5">
              <button (click)="editProduct(product)" 
                      class="flex-1 px-2 py-1.5 bg-gradient-to-r from-sky-500 to-blue-500 hover:from-sky-600 hover:to-blue-600 text-white rounded-md transition-all text-xs font-medium shadow-sm hover:shadow-md flex items-center justify-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
              </button>
              <button (click)="deleteProduct(product)" 
                      class="px-2 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-md transition-all shadow-sm hover:shadow-md">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div *ngIf="products.length === 0" class="col-span-full">
          <div class="bg-white rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">No hay productos</h3>
            <p class="text-sm text-gray-500 mb-4">Comienza agregando tu primer producto</p>
            <button (click)="openCreateModal()" 
                    class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg font-medium transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              Agregar Producto
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Create/Edit Modal -->
    <app-modal [isOpen]="showModal" 
               [title]="editingProduct ? 'Editar Producto' : 'Crear Producto'"
               [confirmText]="editingProduct ? 'Actualizar' : 'Crear'"
               [loading]="saving"
               (closed)="closeModal()"
               (confirmed)="saveProduct()">
      <form class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Producto *</label>
          <input type="text" 
                 [(ngModel)]="formData.nombreProducto" 
                 name="nombreProducto"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="Ingrese el nombre del producto">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Código del Producto *</label>
          <input type="text" 
                 [(ngModel)]="formData.codigoProducto" 
                 name="codigoProducto"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="ej. PRD-001">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Proveedor *</label>
          <select [(ngModel)]="formData.idProveedor" 
                  name="idProveedor"
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500">
            <option value="">Seleccione un proveedor</option>
            <option *ngFor="let supplier of suppliers" [value]="supplier.id">
              {{supplier.razonSocial || supplier.nombreProveedor}}
            </option>
          </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad *</label>
            <input type="number" 
                   [(ngModel)]="formData.cantidadProducto" 
                   name="cantidadProducto"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                   placeholder="0">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Costo *</label>
            <input type="number" 
                   [(ngModel)]="formData.costoProducto" 
                   name="costoProducto"
                   (ngModelChange)="calculatePrice()"
                   step="0.01"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                   placeholder="0.00">
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Ganancia (%) *</label>
          <input type="number" 
                 [(ngModel)]="formData.gananciaProducto" 
                 name="gananciaProducto"
                 (ngModelChange)="calculatePrice()"
                 step="0.01"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="0.00">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Precio de Venta</label>
          <input type="number" 
                 [(ngModel)]="formData.precioProducto" 
                 name="precioProducto"
                 step="0.01"
                 readonly
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="0.00">
          <p class="text-xs text-gray-500 mt-1">Calculado automáticamente: Costo + Ganancia</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">URL de Imagen</label>
          <input type="text" 
                 [(ngModel)]="formData.imageProducto" 
                 name="imageProducto"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="https://ejemplo.com/imagen.jpg">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
          <textarea [(ngModel)]="formData.descripcionProducto" 
                    name="descripcionProducto"
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                    placeholder="Ingrese la descripción del producto"></textarea>
        </div>
      </form>
    </app-modal>
  `
})
export class ProductsListComponent implements OnInit {
  products: any[] = [];
  suppliers: any[] = [];
  showModal = false;
  editingProduct: any = null;
  saving = false;
  formData: any = this.getEmptyFormData();

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadProducts();
    this.loadSuppliers();
  }

  getEmptyFormData() {
    return {
      nombreProducto: '',
      codigoProducto: '',
      idProveedor: '',
      cantidadProducto: 0,
      costoProducto: 0,
      gananciaProducto: 0,
      precioProducto: 0,
      descripcionProducto: '',
      imageProducto: ''
    };
  }

  calculatePrice() {
    const costo = parseFloat(this.formData.costoProducto) || 0;
    const ganancia = parseFloat(this.formData.gananciaProducto) || 0;
    this.formData.precioProducto = costo + ganancia;
  }

  getTotalStock(): number {
    return this.products.reduce((sum, p) => sum + (p.cantidadProducto || 0), 0);
  }

  getLowStockCount(): number {
    return this.products.filter(p => p.cantidadProducto < 10).length;
  }

  getTotalValue(): number {
    return this.products.reduce((sum, p) => sum + (p.cantidadProducto * p.precioProducto || 0), 0);
  }

  loadSuppliers() {
    this.apiService.getProveedores().subscribe({
      next: (data) => this.suppliers = data,
      error: () => this.suppliers = []
    });
  }

  loadProducts() {
    this.apiService.getProductos().subscribe({
      next: (data) => {
        this.products = data;
      },
      error: (err) => {
        console.error('Error loading products:', err);
        this.products = [];
      }
    });
  }

  openCreateModal() {
    this.editingProduct = null;
    this.formData = this.getEmptyFormData();
    this.showModal = true;
  }

  editProduct(product: any) {
    this.editingProduct = product;
    this.formData = { ...product };
    this.showModal = true;
  }

  closeModal() {
    this.showModal = false;
    this.editingProduct = null;
  }

  saveProduct() {
    if (!this.formData.nombreProducto || !this.formData.codigoProducto || !this.formData.idProveedor) {
      alert('Por favor complete todos los campos requeridos incluyendo el proveedor');
      return;
    }

    this.saving = true;
    const productId = this.editingProduct?.id;
    const request = this.editingProduct
      ? this.apiService.updateProducto(productId, this.formData)
      : this.apiService.createProducto(this.formData);

    request.subscribe({
      next: () => {
        this.loadProducts();
        this.closeModal();
        this.saving = false;
      },
      error: (err) => {
        console.error('Error saving product:', err);
        alert('Error al guardar el producto');
        this.saving = false;
      }
    });
  }

  deleteProduct(product: any) {
    if (confirm(`¿Está seguro de eliminar ${product.nombreProducto}?`)) {
      this.apiService.deleteProducto(product.id).subscribe({
        next: () => {
          this.loadProducts();
        },
        error: (err) => {
          console.error('Error deleting product:', err);
          alert('Error al eliminar el producto');
        }
      });
    }
  }
}
