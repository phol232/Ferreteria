import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../../services/api.service';
import { HttpClientModule } from '@angular/common/http';
import { ModalComponent } from '../../shared/modal/modal.component';

@Component({
  selector: 'app-clients-list',
  standalone: true,
  imports: [CommonModule, HttpClientModule, FormsModule, ModalComponent],
  template: `
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Clientes</h1>
          <p class="text-sm text-gray-500 mt-1">Gestiona tu base de clientes</p>
        </div>
        <button (click)="openCreateModal()" 
                class="flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-sky-500 to-blue-500 hover:from-sky-600 hover:to-blue-600 text-white rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Agregar Cliente
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Total Clientes</p>
              <p class="text-2xl font-bold text-gray-900 mt-1">{{clients.length}}</p>
            </div>
            <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Activos</p>
              <p class="text-2xl font-bold text-green-600 mt-1">{{clients.length}}</p>
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
              <p class="text-sm text-gray-500">Ingresos Totales</p>
              <p class="text-2xl font-bold text-gray-900 mt-1">S/ {{totalRevenue.toFixed(2)}}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        <div *ngFor="let client of clients" 
             class="group bg-white rounded-lg border border-gray-200 hover:border-purple-300 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
          <!-- Client Header -->
          <div class="relative h-20 bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 flex items-center justify-center">
            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 via-pink-500 to-rose-500 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg group-hover:scale-110 transition-transform duration-200">
              {{getInitials(client.nombreCliente)}}
            </div>
          </div>

          <!-- Client Info -->
          <div class="p-3">
            <div class="text-center mb-2">
              <h3 class="font-semibold text-sm text-gray-900 truncate">{{client.nombreCliente}}</h3>
              <p class="text-xs text-gray-500">{{client.dniCliente || 'Sin DNI'}}</p>
            </div>
            
            <!-- Contact Info -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-2 mb-2 space-y-1.5">
              <div class="flex items-center gap-1.5 text-xs">
                <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="text-gray-700 truncate">{{client.correoCliente}}</span>
              </div>
              <div class="flex items-center gap-1.5 text-xs">
                <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span class="text-gray-700">{{client.telefonoCliente}}</span>
              </div>
              <div class="flex items-start gap-1.5 text-xs">
                <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-gray-700 line-clamp-2">{{client.direccionCliente}}</span>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-1.5">
              <button (click)="editClient(client)" 
                      class="flex-1 px-2 py-1.5 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-md transition-all text-xs font-medium shadow-sm hover:shadow-md flex items-center justify-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
              </button>
              <button (click)="deleteClient(client)" 
                      class="px-2 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-md transition-all shadow-sm hover:shadow-md">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div *ngIf="clients.length === 0" class="col-span-full">
          <div class="bg-white rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">No hay clientes</h3>
            <p class="text-sm text-gray-500 mb-4">Comienza agregando tu primer cliente</p>
          </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <app-modal [isOpen]="showModal" 
               [title]="editingClient ? 'Editar Cliente' : 'Crear Cliente'"
               [confirmText]="editingClient ? 'Actualizar' : 'Crear'"
               [loading]="saving"
               (closed)="closeModal()"
               (confirmed)="saveClient()">
      <form class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
            <input type="text" 
                   [(ngModel)]="formData.nombreCliente" 
                   name="nombreCliente"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                   placeholder="Juan">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
            <input type="text" 
                   [(ngModel)]="formData.apellidosCliente" 
                   name="apellidosCliente"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                   placeholder="Pérez">
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">DNI / ID</label>
          <input type="text" 
                 [(ngModel)]="formData.dniCliente" 
                 name="dniCliente"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="12345678">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico *</label>
          <input type="email" 
                 [(ngModel)]="formData.correoCliente" 
                 name="correoCliente"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="cliente@ejemplo.com">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono *</label>
          <input type="tel" 
                 [(ngModel)]="formData.telefonoCliente" 
                 name="telefonoCliente"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                 placeholder="+51 999999999">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Dirección *</label>
          <textarea [(ngModel)]="formData.direccionCliente" 
                    name="direccionCliente"
                    rows="2"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                    placeholder="Ingrese la dirección"></textarea>
        </div>
      </form>
    </app-modal>
  `
})
export class ClientsListComponent implements OnInit {
  clients: any[] = [];
  sales: any[] = [];
  totalRevenue: number = 0;
  showModal = false;
  editingClient: any = null;
  saving = false;
  formData: any = {
    nombreCliente: '',
    apellidosCliente: '',
    dniCliente: '',
    correoCliente: '',
    telefonoCliente: '',
    direccionCliente: ''
  };

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadClients();
    this.loadSales();
  }

  loadClients() {
    this.apiService.getClientes().subscribe({
      next: (data) => this.clients = data,
      error: () => this.clients = []
    });
  }

  loadSales() {
    this.apiService.getVentas().subscribe({
      next: (data) => {
        this.sales = data;
        this.totalRevenue = data.reduce((sum: number, sale: any) => sum + (sale.totalVenta || 0), 0);
      },
      error: () => {
        this.sales = [];
        this.totalRevenue = 0;
      }
    });
  }

  getInitials(name: string): string {
    if (!name) return '??';
    return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
  }

  openCreateModal() {
    this.editingClient = null;
    this.formData = {
      nombreCliente: '',
      apellidosCliente: '',
      dniCliente: '',
      correoCliente: '',
      telefonoCliente: '',
      direccionCliente: ''
    };
    this.showModal = true;
  }

  editClient(client: any) {
    this.editingClient = client;
    this.formData = { ...client };
    this.showModal = true;
  }

  closeModal() {
    this.showModal = false;
    this.editingClient = null;
  }

  saveClient() {
    if (!this.formData.nombreCliente || !this.formData.correoCliente) {
      alert('Por favor complete todos los campos requeridos');
      return;
    }

    this.saving = true;
    const clientId = this.editingClient?.id;
    const request = this.editingClient
      ? this.apiService.updateCliente(clientId, this.formData)
      : this.apiService.createCliente(this.formData);

    request.subscribe({
      next: () => {
        this.loadClients();
        this.closeModal();
        this.saving = false;
      },
      error: (err) => {
        console.error('Error saving client:', err);
        alert('Error al guardar el cliente');
        this.saving = false;
      }
    });
  }

  deleteClient(client: any) {
    if (confirm(`¿Está seguro de eliminar a ${client.nombreCliente}?`)) {
      this.apiService.deleteCliente(client.id).subscribe({
        next: () => this.loadClients(),
        error: (err) => alert('Error al eliminar el cliente')
      });
    }
  }
}
